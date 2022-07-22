<?php

namespace App\DataTables;

use App\Models\LatestEdition;
use App\Models\SponsorVideo;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SponsorVideoDataTable extends DataTable
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
            ->addColumn('active', function ($query) {
                $checked = $query->active == 'y' ? 'checked' : '';
                $id = $query->id;
                return view('admin.sponsor._checked', compact('checked', 'id'));
            })
            ->addColumn('action', function ($query) {
                return view('layouts.partials._action', [
                    'table' => 'ad-table',
                    'model' => $query,
                    'edit_url' => route('sponsor-video.edit', $query->id)
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
    public function query(SponsorVideo $model)
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
            ->orderBy(1)
            ->parameters([
                'drawCallback' => 'function() {

                    $(".toggle-class").bootstrapToggle();
                    $(".toggle-class").change(function() {
                        var active = $(this).prop("checked") == true ? "y" : "n";
                        var id = $(this).data("id");

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: "/changeSponsorStatus",
                            data: {"active": active, "id": id},
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
            Column::make('label'),
            Column::make('youtube_id')->title('Youtube ID'),
            Column::make('active')->title('Status'),
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
        return 'Ed_' . date('YmdHis');
    }
}
