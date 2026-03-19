<?php

namespace App\Http\Controllers;

use App\Models\SaveFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaveFileController extends Controller
{
    public function index()
    {
        $files = SaveFile::all();

        return view('#', compact('files')); // a rediriger
    }

    public function form()
    {
        return view('#'); // a rediriger
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|file|max:2048|mimes:jpg,png,pdf,doc,docx',
        ]);

        $file = $request->file('document');

       $path = $file->store('uploads', 'public');

        $saveFile = SaveFile::create([
            'nom' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
        ]);

        return redirect()->route('#'); // a rediriger
    }

    public function show(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        return view('#', compact('saveFile')); // a rediriger
    }


    public function edit(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        return view('#', compact('saveFile')); // a rediriger
    }

    public function update(Request $request, string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $saveFile->update($validated);

        return redirect()->route('#'); // a rediriger
    }

    public function destroy(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        if (Storage::disk('public')->exists($saveFile->path)) {
            Storage::disk('public')->delete($saveFile->path);
        }

        $saveFile->delete();

        return redirect()->route('#'); // a rediriger
    }
}
