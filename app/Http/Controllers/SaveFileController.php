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

        return view('#', compact('files')); //rediriger
    }

    public function form()
    {
        return view('#'); //rediriger
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
        ]);

        return redirect()->route('#'); //rediriger
    }

    public function show(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        return view('#', compact('saveFile'));//rediriger
    }

    public function edit(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        return view('#', compact('saveFile')); //rediriger
    }

    public function update(Request $request, string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $saveFile->update($validated);

        return redirect()->route('#'); //rediriger
    }

    public function destroy(string $id)
    {
        $saveFile = SaveFile::findOrFail($id);

        if (Storage::disk('public')->exists($saveFile->path)) {
            Storage::disk('public')->delete($saveFile->path);
        }

        $saveFile->delete();

        return redirect()->route('#'); //rediriger
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

        return redirect()->route('#', $saveFile->id);
    }

    public function shared(string $token)
    {
        $saveFile = SaveFile::where('share_token', $token)
            ->where('is_public', true)
            ->firstOrFail();

        return view('#', compact('saveFile')); //rediriger
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
