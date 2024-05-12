<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    public function index()
    {
        return view('client.submission.index');
    }
    public function list()
    {
        $submissions = DB::table('submissions')
            ->select(
                'id',
                'title',
                DB::raw("CASE
                WHEN status = 0 THEN 'Pending'
                WHEN status = 1 THEN 'View'
                WHEN status = 2 THEN 'Acceptance'
                WHEN status = 3 THEN 'Rejected'
                ELSE ''
            END AS status",)
            )
            ->get();
        return response()->json($submissions);
    }
    public function add(Request $request)
    {
        if ($request->getMethod() == "GET") {
            return view('client.submission.add');
        } else {
            $submission = new Submission();
            $submission->title = $request->title;
            $submission->description = $request->description;
            $submission->file = $request->file('file')->store('uploads/submission');
            $submission->status = $request->status;
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
            $submission->title = $request->title;
            $submission->description = $request->description;
            if ($request->hasFile('file')) {
                $submission->file = $request->file('file')->store('uploads/submission');
            }
            $submission->status = $request->status;
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
