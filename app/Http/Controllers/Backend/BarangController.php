<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Http\Requests\BarangRequest;
use App\DataTables\BarangDataTable;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BarangDataTable $dataTable)
    {
        $data['title'] = "Barang";
        return $dataTable->render('backend.barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Tambah Barang";
        $jenisbarang = JenisBarang::select('id', 'name')->get();
        return view('backend.barang.create', compact('data', 'jenisbarang'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangRequest $request)
    {
        $barang = new Barang();
        $barang->jenis_barang = $request->jenis_barang;
        $barang->name = $request->name;
        $barang->stok = $request->stok;
        $barang->save();

        return redirect('/backend/barang')->with('status', 'Data barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::find($id);
        $jenisbarang = JenisBarang::select('id', 'name')->get();
        $data['title'] = "Ubah Barang";
        return view('backend.barang.edit', compact('data', 'jenisbarang', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BarangRequest $request, $id)
    {
        $barang = Barang::find($id);
        $barang->jenis_barang = $request->jenis_barang;
        $barang->name = $request->name;
        $barang->stok = $request->stok;
        $barang->save();

        return redirect('/backend/barang')->with('status', 'Barang diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect('/backend/barang')->with('status', 'Barang dihapus');
    }
}
