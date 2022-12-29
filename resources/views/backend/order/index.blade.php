@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ url('/backend/order/create') }}" class="btn btn-primary mb-4">Tambah</a>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Filter Data</h5>
                        <div class="row g-3">
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input id="tanggal_awal" type="date"
                                        class="form-control @error('tanggal_awal') is-invalid @enderror" name="tanggal_awal"
                                        value="{{ old('tanggal_awal') }}" required autocomplete="tanggal_awal" autofocus
                                        placeholder="Tanggal Awal">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input id="tanggal_akhir" type="date"
                                        class="form-control @error('tanggal_akhir') is-invalid @enderror"
                                        name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" required
                                        autocomplete="tanggal_akhir" autofocus placeholder="Tanggal Akhir">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="text" id="btnFiterSubmitSearch" class="btn btn-primary">Cari Data</button>
                                <button type="text" id="btnFiterReset" class="btn btn-secondary"><i
                                        class="bi bi-arrow-clockwise"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
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
                        {{ $dataTable->table() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script type="text/javascript">
        $(document).ready(function() {
            let table = $('#order-table');

            $('#btnFiterSubmitSearch').click(function() {
                tableFilter($('#tanggal_awal').val(), $('#tanggal_akhir').val())
                table.DataTable().ajax.reload()
            });

            function tableFilter(startDate, endDate) {
                table.on('preXhr.dt', function(e, settings, data) {
                    data.start_date = startDate;
                    data.end_date = endDate;
                })
            }

            $('#btnFiterReset').on('click', function() {
                tableFilter(null)
                table.DataTable().ajax.reload()
            })
        });
    </script>
@endpush
