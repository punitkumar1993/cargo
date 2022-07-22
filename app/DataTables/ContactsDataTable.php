<?php

namespace App\DataTables;

use App\Models\Contact;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ContactsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function($query){
                return '<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input contact_checkbox" id="checkbox'.$query->id.'" name="ad_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('F d, Y H:i');
            })
            ->addColumn('action', function ($query) {
                return view('layouts.partials._action-contact', [
                    'table' => 'contact-table',
                    'model' => $query,
                    'del_url' => route('contacts.destroy', $query->id),
                    'show_url' => route('contacts.show', $query->id)
                ]);
            })
            ->rawColumns(['checkbox']);;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Contact $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contact $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('contact-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>")
            ->orderBy(1)->parameters([
                'drawCallback' => 'function() {
                    $(".delete").click(function() {;
                        table = $(this).data("table");
                        url = $(this).data("url");
                        sweetalert2(table,url);
                    })

                    $("#bulk_delete").click(function() {
                        url = $(this).data("url");
                        table = "contact-table";
                        selectClass = "contact_checkbox";
                        multiDelCheckbox(table,url,selectClass);
                    })

                    $("#selectAll").on( "click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".contact_checkbox").prop("checked",true);
                        } else {
                            $(".contact_checkbox").prop("checked",false);
                        }
                    })
                }'
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('checkbox')
                ->title('')
                ->footer('<div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="selectAll"><label class="custom-control-label" for="selectAll"></label></div>')
                ->addClass('text-center')
                ->orderable(false)
                ->searchable(false)
                ->width(3),
            Column::make('id')->title('ID')
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger"
                    data-url="'.route('contacts.massdestroy').'">Delete</button>'),
            Column::make('name'),
            Column::make('subject'),
            Column::make('status'),
            Column::make('created_at')->title('Date'),
            Column::computed('action')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Contact_' . date('YmdHis');
    }
}
