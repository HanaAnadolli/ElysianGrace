<?php

namespace App\DataTables;

use App\Models\ContactForm;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;

class ContactFormDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable($query)
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($contactForm) {

                $markAsReadBtn = !$contactForm->is_read ? view('components.view-button', [
                    'route' => route('contact_forms.markAsRead', $contactForm->id),
                    'slot' => 'Mark as Read'
                ])->render() : '';

                return '<div class="action-buttons">' .$markAsReadBtn . '</div>';
            })
            ->editColumn('created_at', function ($contactForm) {
                return $contactForm->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('is_read', function ($contactForm) {
                return $contactForm->is_read ? 'Read' : 'Unread';
            })
            ->rawColumns(['action'])
            ->setRowClass(function ($contactForm) {
                return $contactForm->is_read ? '' : 'bg-warning'; // Highlight unread entries
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ContactForm $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ContactForm $model)
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
            ->setTableId('contact-forms-table')
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
            Column::make('name'),
            Column::make('email'),
            Column::make('message'),
            Column::make('created_at'),
            Column::make('is_read'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
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
        return 'ContactForms_' . date('YmdHis');
    }
}
