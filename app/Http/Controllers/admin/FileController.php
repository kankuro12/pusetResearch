<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index(Request $request){
        $filename=urldecode($request->filename);
        if (!Storage::exists($filename)) {
            abort(404);
        }
        $mimeType = Storage::mimeType($filename);
        return response()->file(storage_path('app/'.$filename), ['Content-Type' => $mimeType]);
    }
}
