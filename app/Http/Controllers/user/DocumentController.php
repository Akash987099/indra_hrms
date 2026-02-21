<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Document;

class DocumentController extends Controller
{
    // ✅ LIST
    public function index()
    {
        $user = Auth::guard('user')->user();

        $foldername = $user->employee_code;

        // folder create if not exist
        $path = public_path('documents/' . $foldername);

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $documents = Document::where('emp_code', $foldername)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('employee.document.index', compact('documents', 'foldername'));
    }

    // ✅ STORE (UPLOAD)
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:2048'
        ]);

        $user = Auth::guard('user')->user();
        $foldername = $user->employee_code;

        $folder = public_path('documents/' . $foldername);

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0777, true, true);
        }

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        $file->move($folder, $filename);

        Document::create([
            'emp_code' => $foldername,
            'file_name' => $filename,
            'file_path' => 'documents/' . $foldername . '/' . $filename
        ]);

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        $doc = Document::findOrFail($id);

        if (File::exists(public_path($doc->file_path))) {
            File::delete(public_path($doc->file_path));
        }

        $doc->delete();

        return response()->json(['success' => true]);
    }
}