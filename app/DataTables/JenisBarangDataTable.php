<?php

namespace App\DataTables;

use App\Models\JenisBarang;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JenisBarangDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            //->addColumn('action', 'jenisbarang.action')
            ->editColumn('action', function ($row) {
                $actionBtn = '<form action="' . url('/backend/jenis-barang', $row->id) . '" method="POST">
                ' . csrf_field() . '
                ' . method_field("DELETE") . '
                <a href="' . url('/backend/jenis-barang/') . '/' . $row->id . '/edit" class="btn btn-sm btn-secondary text-white"><i class="bi bi-pencil"></i></a>
                <button type="submit" class="btn btn-sm btn-danger"
                    onclick="return confirm(\'Hapus data ' . $row->name . '?\')"><i class="bi bi-trash"></i></a>
                </form>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\JenisBarang $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JenisBarang $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('jenisbarang-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')->title('Jenis Barang'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'JenisBarang_' . date('YmdHis');
    }
}
