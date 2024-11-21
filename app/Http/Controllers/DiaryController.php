<?php

namespace App\Http\Controllers;

use App\Models\Diary;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    /**
     * Display a listing of the diaries.
     */
    public function index()
    {
        // Mengambil semua data diary dari database
        $diaries = Diary::all();
        return view('diary.index', compact('diaries'));
    }

    /**
     * Show the form for creating a new diary entry.
     */
    public function create()
    {
        return view('diary.create');
    }

    /**
     * Store a newly created diary entry in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
        ]);

        // Menyimpan diary baru ke database
        Diary::create([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return redirect()->route('diary.index');
    }

    /**
     * Display the specified diary entry.
     */
    public function show($id)
    {
        // Ambil diary berdasarkan ID
        $diary = Diary::findOrFail($id);
        return view('diary.show', compact('diary'));
    }

    /**
     * Show the form for editing the specified diary entry.
     */
    public function edit($id)
    {
        $diary = Diary::findOrFail($id);
        return view('diary.edit', compact('diary'));
    }

    /**
     * Update the specified diary entry in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'text' => 'required',
        ]);

        // Ambil diary berdasarkan ID
        $diary = Diary::findOrFail($id);

        // Update data diary
        $diary->update([
            'title' => $request->title,
            'text' => $request->text,
        ]);

        return redirect()->route('diary.index');
    }

    /**
     * Remove the specified diary entry from storage.
     */
    public function destroy($id)
    {
        $diary = Diary::findOrFail($id);
        $diary->delete();

        return redirect()->route('diary.index');
    }
}
