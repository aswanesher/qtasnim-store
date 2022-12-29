@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ url('/backend/barang') }}" class="btn btn-primary mb-4">Kembali</a>
                <div class="card">
                    <div class="card-header">
                        {{ $data['title'] }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('barang.update', $barang->id) }}">
                            @method('PATCH')
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jenis Barang</label>
                                <select name="jenis_barang" id="jenis_barang"
                                    class="form-control @error('jenis_barang') is-invalid @enderror">
                                    @foreach ($jenisbarang as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $barang->jenis_barang == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jenis_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Nama Barang" value="{{ $barang->name }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Stok</label>
                                <input type="text" class="form-control @error('stok') is-invalid @enderror"
                                    id="stok" name="stok" placeholder="Stok Barang" value="{{ $barang->stok }}">
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
