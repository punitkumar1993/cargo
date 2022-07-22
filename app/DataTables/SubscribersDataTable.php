<?php

namespace App\DataTables;

use App\Models\Subscriber;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;


class SubscribersDataTable extends DataTable
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
            ->addColumn('unsubscribe', function ($query) {
                $checked = $query->unsubscribe ? '' : 'checked';
                $id = $query->id;
                return view('admin.subscribers._checked', compact('checked', 'id'));
            })
            ->addColumn('action', function ($query) {
                return view('layouts.partials._action', [
                    'table' => 'ad-table',
                    'model' => $query,
                    'edit_url' => route('subscriber.edit', $query->id)
                ]);
            })
            ->rawColumns(['checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Adspace $model
     * @return \Illuminate\Database\Query\Builder
     */
    public function query(Subscriber $model)
    {
        return $model->latest()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('ad-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>")
            ->buttons(
                    Button::make('create')->className('btn btn-sm btn-info')
            )
            ->orderBy(1)
            ->parameters([
                'drawCallback' => 'function() {

                    $(".toggle-class").bootstrapToggle();
                    $(".toggle-class").change(function() {
                        var unsubscribe = $(this).prop("checked") == true ? "0" : "1";
                        var id = $(this).data("id");

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: "/changeSubscribeStatus",
                            data: {"unsubscribe": unsubscribe, "id": id},
                            success: function(data) {
                                toastr.success(data.success, {timeOut: 5000})
                            }
                        })
                    })
                }'
            ]);
    }

    public function custom()
    {
        return 'custom';
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID')
                ->addClass('text-center'),
            Column::make('email'),
            Column::make('unsubscribe')->title('Subscribe?'),
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
        return 'Ad_' . date('YmdHis');
    }
}
