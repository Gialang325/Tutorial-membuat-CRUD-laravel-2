<?php
// Tempatkan file kode ini di dalam folder projek-laravel\App\Http\Controllers
namespace App\Http\Controllers;

use App\Models\Projek; 
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProjekController extends Controller
{
    public function index() : View
    {
        $projek = Projek::all();
        return view('projek.index', compact('projek'));
    }

    public function create(): View
    {
        return view('projek.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'kelas'        => 'required|numeric',
            'jurusan'      => 'required|string|max:255'
        ]);

        Projek::create([
            'nama'          => $request->nama,
            'kelas'         => $request->kelas,
            'jurusan'       => $request->jurusan,
        ]);

        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $projek = Projek::findOrFail($id);

        return view('projek.edit', compact('projek'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'kelas'        => 'required|numeric',
            'jurusan'      => 'required|string|max:255'
        ]);

        $projek = Projek::findOrFail($id);

        $projek->update([
            'nama'          => $request->nama,
            'kelas'         => $request->kelas,
            'jurusan'       => $request->jurusan,
        ]);

        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(string $id): RedirectResponse
    {
        $projek = Projek::findOrFail($id);

        $projek->delete();

        return redirect()->route('projek.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
