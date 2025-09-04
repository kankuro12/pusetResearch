<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UserVerificationController extends Controller
{
    /**
     * Show list of unverified users
     */
    public function index()
    {
    return view('admin.users.index');
    }

    /**
     * Show create user form
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store new user created by admin (auto-verified, role=1)
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // client role
        $user->role = 1;
        // auto verify when admin creates
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User created and verified');
    }

    /**
     * Verify a user manually
     */
    public function verify(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        if ($user->email_verified_at) {
            return redirect()->back()->with('info', 'User already verified');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->back()->with('success', 'User email marked as verified');
    }

    /**
     * Legacy unverified page
     */
    public function unverified(Request $request)
    {
        $users = User::whereNull('email_verified_at')->orderBy('id','desc')->paginate(20);
        return view('admin.users.unverified', compact('users'));
    }

    /**
     * Return all users as JSON for DataTables
     */
    public function listJson(Request $request): JsonResponse
    {
        $users = User::withCount('submissions')
            ->orderBy('id', 'desc')
            ->where('role', 1)
            ->get();

        $data = $users->map(function($user){
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at ? $user->created_at->format('Y-m-d H:i') : '',
                'verified' => $user->email_verified_at ? 'Yes' : 'No',
                'no_of_submissions' => $user->submissions_count,
                'actions' => view('admin.users._actions', compact('user'))->render(),
            ];
        });

        return response()->json(['data' => $data]);
    }

    /**
     * Change a user's password (admin)
     */
    public function changePassword(Request $request, $user_id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

    Log::info('Admin changed user password', ['admin_id' => Auth::check() ? Auth::id() : null, 'user_id' => $user->id]);

        return response()->json(['status' => 'success', 'message' => 'Password updated']);
    }

    /**
     * Toggle block state by clearing or setting email_verified_at
     */
    public function toggleBlock(Request $request, $user_id): JsonResponse
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }

        if ($user->email_verified_at) {
            // block by setting to null
            $user->email_verified_at = null;
            $action = 'blocked';
        } else {
            // unblock by setting to now
            $user->email_verified_at = now();
            $action = 'unblocked';
        }
        $user->save();

    Log::info('Admin toggled user block', ['admin_id' => Auth::check() ? Auth::id() : null, 'user_id' => $user->id, 'action' => $action]);

        return response()->json(['status' => 'success', 'message' => "User {$action}", 'verified' => $user->email_verified_at ? 'Yes' : 'No']);
    }
}
