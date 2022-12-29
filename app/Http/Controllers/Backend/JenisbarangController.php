<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JenisBarang;
use App\DataTables\JenisBarangDataTable;
use App\Http\Requests\JenisBarangRequest;

class JenisbarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JenisBarangDataTable $dataTable)
    {
        $data['title'] = "Kategori Barang";
        return $dataTable->render('backend.jenisbarang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Tambah Jenis Barang";
        return view('backend.jenisbarang.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JenisBarangRequest $request)
    {
        $jenisBarang = new JenisBarang;
        $jenisBarang->name = $request->jenis_barang;
        $jenisBarang->save();

        return redirect('/backend/jenis-barang')->with('status', 'Data jenis barang berhasil ditambahkan');
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
        $data = JenisBarang::find($id);
        $data['title'] = "Ubah Jenis Barang";
        return view('backend.jenisbarang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JenisBarangRequest $request, $id)
    {
        $jenisBarang = JenisBarang::find($id);
        $jenisBarang->name = $request->jenis_barang;
        $jenisBarang->save();

        return redirect('/backend/jenis-barang')->with('status', 'Jenis barang diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jenisBarang = JenisBarang::find($id);
        $jenisBarang->delete();

        return redirect('/backend/jenis-barang')->with('status', 'Jenis barang dihapus');
    }
}
