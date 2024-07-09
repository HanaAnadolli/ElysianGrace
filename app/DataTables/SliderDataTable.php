<?php

namespace App\DataTables;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class SliderDataTable extends DataTable
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
        ->addColumn('action', function ($query) {
            $editBtn = view('components.edit-button', [
                'route' => route('category.edit', $query->id),
                'slot' => 'Edit'
            ])->render();

            $deleteBtn = view('components.delete-button', [
                'route' => route('category.destroy', $query->id),
                'slot' => 'Delete'
            ])->render();

            return '<div class="action-buttons">' . $editBtn . $deleteBtn . '</div>';
        })
        ->addColumn('banner', function ($query) {
            return $img = "<img width='50px' src='" . asset($query->banner) . "' ></img>";
        })->addColumn('status', function($query){
            if($query->status == 1){
                $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" checked name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status" >
                    <span class="custom-switch-indicator"></span>
                </label>';
            }else {
                $button = '<label class="custom-switch mt-2">
                    <input type="checkbox" name="custom-switch-checkbox" data-id="'.$query->id.'" class="custom-switch-input change-status">
                    <span class="custom-switch-indicator"></span>
                </label>';
            }
            return $button;
        })
        ->editColumn('description', function ($query) {
            return Str::limit($query->description, 50);
        })
        ->rawColumns(['banner','action','status','description'])
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Slider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Slider $model): QueryBuilder
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
                    ->setTableId('slider-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
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
            Column::make('banner')->width(200),
            Column::make('title'),
            Column::make('description'),
            Column::make('status'),
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
        return 'Slider_' . date('YmdHis');
    }
}
