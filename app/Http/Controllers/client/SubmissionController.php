<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function index()
    {
        return view('client.submission.index');
    }
    public function list()
    {
        $submissions = DB::table('submissions')->get(['id','title']);
        return response()->json($submissions);
    }
    public function add(Request $request)
    {
        if ($request->getMethod() == "GET") {
            return view('client.submission.add');
        } else {

            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'file' => 'required|file|mimes:pdf',
            ]);

            $user = Auth::user();
            $submission = new Submission();
            $submission->title = $request->title;
            $submission->description = $request->description;
            $submission->file = $request->file('file')->store('uploads/submission');
            $submission->status = 0 ;
            $submission->user_id = $user->id;
            $submission->save();
        }
        return redirect()->back()->with('success', 'successfully added');
    }
    public function edit(Request $request, $sub_id)
    {
        $submission = Submission::where('id', $sub_id)->first();
        if ($request->getMethod() == "GET") {
            return view('client.submission.edit', compact('submission'));
        } else {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'file' => 'required|file|mimes:pdf',
            ]);
            $submission->title = $request->title;
            $submission->description = $request->description;
            if ($request->hasFile('file')) {
                $submission->file = $request->file('file')->store('uploads/submission');
            }
            $submission->status = 0;
            $submission->save();
        }
        return redirect()->back()->with('success', 'successfully updated');
    }

    public function del($sub_id)
    {
        Submission::where('id', $sub_id)->delete();
        return redirect()->back()->with('success', 'successfully deleted');
    }
}
