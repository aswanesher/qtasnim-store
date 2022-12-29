@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ url('/backend/jenis-barang') }}" class="btn btn-primary mb-4">Kembali</a>
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

                        <form method="POST" action="{{ url('/backend/jenis-barang/') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Jenis Barang</label>
                                <input type="text" class="form-control @error('jenis_barang') is-invalid @enderror"
                                    id="jenis_barang" name="jenis_barang" placeholder="Jenis Barang">
                                @error('jenis_barang')
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
