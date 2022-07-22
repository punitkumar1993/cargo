<?php

namespace App\DataTables;

use App\Helpers\Settings;
use App\Models\Magazine;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MagazinesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('name', function ($query) {
                return $query->name;
            })
            ->editColumn('e_magazine', function ($query) {
                return "<a href='" . route('magazine.read', $query->id) . "' target='_blank'>View Magazine</a>";
            })
            ->editColumn('e_template', function ($query) {
                return "<a href='" . route('view.magazine', $query->id) . "' target='_blank'>View Template</a>";
            })
            ->addColumn('action', function ($query) {
                $action = [
                    'table' => 'magazine-table',
                    'model' => $query,
                ];

                if (Auth::User()->hasRole(['superadmin'])) {
                    $action['del_url'] = route('magazines.destroy', $query->id);
                    $action['edit_url'] = route('magazines.edit', $query->id);
                }

                return view('layouts.partials._action', $action);
            })
            ->rawColumns(['e_magazine', 'e_template', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Magazine $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Magazine $model)
    {
        return Magazine::latest()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        $result = $this->builder()
            ->setTableId('magazine-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                             'drawCallback' => 'function() {
                    "use strict";

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        sweetalert2(table, url);
                    })

                }'
                         ]);

        if (Auth::User()->hasRole(['superadmin'])) {
            $result->dom("<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" .
                         "<'row'<'col-sm-12'tr>>" .
                         "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>")
                ->buttons(
                    Button::make('create')->className('btn btn-sm btn-info')
                );
        }

        return $result;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if (Auth::User()->hasRole(['superadmin'])) {
            return [
                Column::make('id')->title('ID'),
                Column::make('name')->title('Magazine Name'),
                Column::make('e_magazine')->title('e-Magazine'),
                Column::make('e_template')->title('e-Template'),
                Column::computed('action')->addClass('text-center'),
            ];
        }else{
            return [
                Column::make('id')->title('ID'),
                Column::make('name')->title('Magazine Name'),
                Column::make('e_magazine')->title('e-Magazine'),
            ];
        }

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Magazine_' . date('YmdHis');
    }
}
