<?php

namespace App\Http\Controllers;

use App\Models\CentroCivico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CentrosController extends Controller
{
    public function edit($id)
    {
        $centro = CentroCivico::findOrFail($id);
        return view('centros.edit', compact('centro'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'horario' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $centro = CentroCivico::findOrFail($id);
        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($centro->foto) {
                Storage::disk('public')->delete('img/' . $centro->foto);
            }

            $nombreFoto = time() . "-" . $request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('img', $nombreFoto, 'public');

            $data['foto'] = $nombreFoto;
        }

        $centro->update($data);
        return redirect()->route('centros.index')->with('success', 'Centro actualizado con éxito');
    }

    public function destroy($id)
    {
        $centro = CentroCivico::findOrFail($id);
        if ($centro->foto) {
            Storage::disk('public')->delete('img/' . $centro->foto);
        }
        $centro->delete();
        return redirect()->route('centros.index')->with('success', 'Centro eliminado con éxito');
    }

    public function showCreateForm()
    {
        return view('centros.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|m  ax:255',
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'horario' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $nombreFoto = time() . "-" . $request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('img', $nombreFoto, 'public');
            $data['foto'] = $nombreFoto;
            \Log::info('Archivo guardado en: ' . $path);
        } else {
            \Log::warning('No se ha recibido ningún archivo.');
        }

        CentroCivico::create($data);
        return redirect()->route('centros.index')->with('success', 'Centro creado con éxito');
    }

}