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

                        <form method="POST" action="{{ url('/backend/order/') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                <select name="barang" id="barang"
                                    class="form-control @error('barang') is-invalid @enderror">
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jumlah dipesan</label>
                                <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty"
                                    name="qty" placeholder="Kuantiti pesanan">
                                @error('qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tanggal pemesanan</label>
                                <input type="date" class="form-control @error('order_date') is-invalid @enderror"
                                    id="order_date" name="order_date" placeholder="Tanggal Pemesanan">
                                @error('order_date')
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
