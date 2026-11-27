<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Jendela Home: Menampilkan daftar ToDo
    public function index()
    {
        $todos = Todo::orderBy('is_selesai', 'asc')
                     ->orderBy('created_at', 'desc')
                     ->get();

        return view('todos.index', compact('todos'));
    }

    // Jendela Form: Menampilkan halaman tambah ToDo
    public function create()
    {
        return view('todos.create');
    }

    // Proses Simpan ToDo Baru ke Database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:150',
            'keterangan' => 'nullable|string',
        ]);

        $selesai = $request->has('is_selesai');

        Todo::create([
            'judul'           => $validated['judul'],
            'keterangan'      => $validated['keterangan'] ?? null,
            'is_selesai'      => $selesai,
            'tanggal_selesai' => $selesai ? now() : null,
        ]);

        return redirect()->route('todos.index')->with('sukses', 'ToDo berhasil ditambahkan!');
    }

    // Fitur Tambahan: Centang / Batal Selesai langsung dari halaman Home
    public function toggle(Todo $todo)
    {
        $statusBaru = !$todo->is_selesai;

        $todo->update([
            'is_selesai'      => $statusBaru,
            'tanggal_selesai' => $statusBaru ? now() : null,
        ]);

        return redirect()->route('todos.index');
    }

    // Fitur Tambahan: Hapus ToDo
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index')->with('sukses', 'ToDo berhasil dihapus.');
    }
}