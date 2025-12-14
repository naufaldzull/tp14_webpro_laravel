<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FilmController extends Controller
{
    private function api()
    {
        return rtrim(env('EXPRESS_API_URL', 'http://localhost:3000'), '/');
    }

    public function index()
    {
        try {
            $response = Http::timeout(3)->get($this->api() . '/films');
            $films = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            $films = [];
            session()->flash('error', 'Tidak dapat terhubung ke API Express. Pastikan server Express berjalan di port 3000.');
        }
        return view('films.index', compact('films'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'tanggal_rilis' => 'nullable|date',
            'rating' => 'nullable|numeric',
        ]);

        try {
            Http::timeout(3)->post($this->api() . '/films', $request->only('nama','deskripsi','tanggal_rilis','rating'));
        } catch (\Exception $e) {
            return redirect()->route('films.index')->with('error', 'Gagal menambahkan film. Server Express tidak merespon.');
        }
        return redirect()->route('films.index');
    }

    public function edit($id)
    {
        try {
            $films = Http::timeout(3)->get($this->api() . '/films')->json();
            $film = collect($films)->firstWhere('id', $id);

            if (!$film) return redirect()->route('films.index');

            return view('films.edit', compact('film'));
        } catch (\Exception $e) {
            return redirect()->route('films.index')->with('error', 'Tidak dapat mengambil data film dari API Express.');
        }
    }


    public function update(Request $request, $id)
    {
        try {
            Http::timeout(3)->put($this->api() . "/films/$id", $request->only('nama','deskripsi','tanggal_rilis','rating'));
        } catch (\Exception $e) {
            return redirect()->route('films.index')->with('error', 'Gagal mengupdate film. Server Express tidak merespon.');
        }
        return redirect()->route('films.index');
    }

    public function destroy($id)
    {
        try {
            Http::timeout(3)->delete($this->api() . "/films/$id");
        } catch (\Exception $e) {
            return redirect()->route('films.index')->with('error', 'Gagal menghapus film. Server Express tidak merespon.');
        }
        return redirect()->route('films.index');
    }
}