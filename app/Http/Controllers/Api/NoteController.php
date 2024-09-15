<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    // Ambil semua catatan berdasarkan user ID
    public function index(Request $request)
    {
        $notes = Note::where('user_id', $request->user()->id)->orderBy('id', 'desc')->get();
        return response()->json(['notes' => $notes], 200);
    }

    // Membuat catatan baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'note' => 'required',
        ]);

        $note = new Note();
        $note->user_id = $request->user()->id;
        $note->title = $request->title;
        $note->note = $request->note;
        $note->save();

        return response()->json(['message' => 'Note created successfully'], 201);
    }

    // Mengedit catatan yang ada
    public function update(Request $request, $id)
    {
        $note = Note::where('user_id', $request->user()->id)->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'required|string',
        ]);

        $note->title = $request->title;
        $note->note = $request->note;
        $note->save();

        return response()->json(['message' => 'Note updated successfully'], 200);
    }

    // Menghapus catatan
    public function destroy(Request $request, $id)
    {
        $note = Note::where('user_id', $request->user()->id)->findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully'], 200);
    }
}
