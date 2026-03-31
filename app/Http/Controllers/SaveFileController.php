<?php

namespace App\Http\Controllers;

use App\Models\SaveFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SaveFileController extends Controller
{
    public function index()
    {
        $files = SaveFile::latest()->get();

        return view('documents.index', compact('files'));
    }

    public function form()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'document' => [
                'required',
                'file',
                'min:10',
                'max:5120',
                'mimes:jpg,jpeg,png,pdf,doc,docx',
            ],
        ]);

        $file = $request->file('document');
        $path = $file->store('uploads', 'public');

        SaveFile::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'size' => $file->getSize(),
            'share_token' => Str::random(40),
            'is_public' => false,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('save-files.index');
    }

    public function show(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        return view('documents.show', compact('saveFile'));
    }

    public function edit(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        return view('documents.edit', compact('saveFile'));
    }

    public function update(Request $request, string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $saveFile->update($validated);

        return redirect()->route('save-files.index');
    }

    public function destroy(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        if (Storage::disk('public')->exists($saveFile->path)) {
            Storage::disk('public')->delete($saveFile->path);
        }

        $saveFile->delete();

        return redirect()->route('save-files.index');
    }

    public function download(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        if (!Storage::disk('public')->exists($saveFile->path)) {
            abort(404, 'Fichier introuvable.');
        }

        return Storage::disk('public')->download($saveFile->path, $saveFile->name);
    }

    public function toggleShare(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        $saveFile->is_public = !$saveFile->is_public;

        if (empty($saveFile->share_token)) {
            $saveFile->share_token = Str::random(40);
        }

        $saveFile->save();

        return redirect()->route('save-files.show', $saveFile->id);
    }

    public function shared(string $token)
    {
        $saveFile = SaveFile::where('share_token', $token)
            ->where('is_public', true)
            ->firstOrFail();

        return view('documents.shared', compact('saveFile'));
    }

    public function sharedDownload(string $token)
    {
        $saveFile = SaveFile::where('share_token', $token)
            ->where('is_public', true)
            ->firstOrFail();

        if (!Storage::disk('public')->exists($saveFile->path)) {
            abort(404, 'Fichier introuvable.');
        }

        return Storage::disk('public')->download($saveFile->path, $saveFile->name);
    }
}
