<?php

namespace App\DataTables;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserBookingsDataTable extends DataTable
{
    protected $email;

    /**
     * Constructor to set the email.
     *
     * @param string $email
     */
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('room_name', function ($query) {
                return $query->room->title;
            })
            ->editColumn('check_in_date', function ($query) {
                return $query->room->selected_in_date->format('Y-m-d');
            })
            ->editColumn('check_out_date', function ($query) {
                return $query->room->selected_out_date->format('Y-m-d'); 
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($query) {
                return $query->updated_at->format('Y-m-d H:i:s');
            })
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
        // Only show bookings for the authenticated user's email
        return $model->newQuery()
            ->where('email', $this->email)
            ->with('room'); // Eager load the room relationship
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-bookings-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0)
            ->selectStyleSingle();
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
            Column::make('room_name')->title('Room Name'),
            Column::make('check_in_date')->title('Check-In Date'),
            Column::make('check_out_date')->title('Check-Out Date'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'UserBookings_' . date('YmdHis');
    }
}
