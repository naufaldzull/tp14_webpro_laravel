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
        $response = Http::get($this->api() . '/films');
        $films = $response->successful() ? $response->json() : [];
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

        Http::post($this->api() . '/films', $request->only('nama','deskripsi','tanggal_rilis','rating'));
        return redirect()->route('films.index');
    }

    public function edit($id)
    {
        $films = Http::get($this->api() . '/films')->json();
        $film = collect($films)->firstWhere('id', $id);

        if (!$film) return redirect()->route('films.index');

        return view('films.edit', compact('film'));
    }


    public function update(Request $request, $id)
    {
        Http::put($this->api() . "/films/$id", $request->only('nama','deskripsi','tanggal_rilis','rating'));
        return redirect()->route('films.index');
    }

    public function destroy($id)
    {
        Http::delete($this->api() . "/films/$id");
        return redirect()->route('films.index');
    }
}