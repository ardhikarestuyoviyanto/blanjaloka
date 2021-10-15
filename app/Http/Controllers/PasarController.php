<?php

namespace App\Http\Controllers;

use App\Models\Pasar;
use Illuminate\Http\Request;
use Validator;

class PasarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'pasar' => Pasar::all()
        ];

        return view('admin/pasar/index', $data)->with(['title' => 'Data Pasar', 'sidebar' => 'Data Pasar']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pasar = new Pasar;
        $data = [
            'pasar' => $pasar
        ];
        return view('admin/pasar/create', $data)->with(['title' => 'Data Pasar', 'sidebar' => 'Data Pasar']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'foto_pasar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $imageName = time() . '.' . $request->foto_pasar->extension();

        $request->foto_pasar->move(public_path('assets/admin/foto_pasar/'), $imageName);

        $pasar = new Pasar;
        $pasar->nama_pasar = $request->nama_pasar;
        $pasar->alamat = $request->alamat;
        $pasar->embbed_maps = $request->embbed_maps;
        $pasar->foto_pasar = $imageName;
        $pasar->operasional_pasar = $request->operasional_pasar;
        $pasar->save();

        return redirect('admin/pasar')->with('pesan', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pasar  $pasar
     * @return \Illuminate\Http\Response
     */
    public function show(Pasar $pasar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pasar  $pasar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasar = Pasar::find($id);
        $data = [
            'pasar' => $pasar
        ];
        return view('admin/pasar/edit', $data)->with(['title' => 'Data Pasar', 'sidebar' => 'Data Pasar']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pasar  $pasar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'foto_pasar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $imageName = time() . '.' . $request->foto_pasar->extension();

        $request->foto_pasar->move(public_path('assets/admin/foto_pasar/'), $imageName);

        $pasar = Pasar::find($id);
        $pasar->nama_pasar = $request->nama_pasar;
        $pasar->alamat = $request->alamat;
        $pasar->embbed_maps = $request->embbed_maps;
        $pasar->foto_pasar = $imageName;
        $pasar->operasional_pasar = $request->operasional_pasar;
        $pasar->save();

        return redirect('admin/pasar')->with('pesan', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pasar  $pasar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pasar = Pasar::find($id);

        unlink('assets/admin/foto_pasar/' . $pasar['foto_pasar']);

        $pasar->delete();
        return redirect('admin/pasar')->with('pesan', 'Data berhasil dihapus');
    }
}
