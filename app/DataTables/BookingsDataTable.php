<?php

namespace App\DataTables;

use App\Models\Booking;
use App\Models\User; // Import User model
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BookingsDataTable extends DataTable
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
            ->addColumn('email_exists', function ($query) {
                $emailExists = User::where('email', $query->email)->exists();
                return $emailExists ? '<span class="text-green-600"><i class="fa fa-check"></i></span>' : '<span class="text-red-600"><i class="fa fa-times"></i></span>';
            })
            ->addColumn('action', function ($query) {
                $approveBtn = '<button class="btn btn-success approve-booking" data-id="' . $query->id . '">
                                   <i class="fa fa-check"></i> Confirm
                               </button>';
                $rejectBtn = '<button class="btn btn-danger reject-booking" data-id="' . $query->id . '">
                                  <i class="fa fa-times"></i> Reject
                              </button>';
            
                return '<div class="btn-group">' . $approveBtn . ' ' . $rejectBtn . '</div>';
            })            
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['email_exists', 'action'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Booking $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Booking $model): QueryBuilder
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
            ->setTableId('bookings-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
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
            Column::make('id'),
            Column::make('room_id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('email_exists')->title('Email Exists'),
            Column::make('phone'),
            Column::make('comments'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
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
        return 'Bookings_' . date('YmdHis');
    }
}
