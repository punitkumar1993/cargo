<?php

namespace App\DataTables;

use App\Models\Advertisement;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NewslettersDataTable extends DataTable
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
                return view('admin.newsletters._checked', compact('checked', 'id'));
            })
            ->editColumn('space_id', function ($query) {
                if($query->space()->exists()){
                    $spaceName = $query->space->name;
                    if ($spaceName == 'home-horizontal'){
                        return 'Home Top';
                    }else if ($spaceName == 'home-bottom'){
                        return 'Home Bottom';
                    }else if ($spaceName == 'home-center'){
                        return 'Home Middle';
                    }else if ($spaceName == 'sidebar-right-top'){
                        return 'Sidebar Top';
                    }else if ($spaceName == 'sidebar-right-bottom'){
                        return 'Sidebar Middle';
                    }else if ($spaceName == 'sidebar-right-second-bottom'){
                        return 'Sidebar Bottom';
                    }else{
                        return $spaceName;
                    }
                }else{
                    return 'Not set';
                }

//                return ($query->space()->exists()) ? $query->space->name : 'Not set';
            })
            ->addColumn('action', function ($query) {
                return view('layouts.partials._action', [
                    'table' => 'ad-table',
                    'model' => $query,
                    'edit_url' => route('newsletter.edit', $query->id),
                    'del_url' => route('newsletter.destroy', $query->id),
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
    public function query(Advertisement $model)
    {
        return $model->where('news_active','y')->with('space')->latest()->newQuery();
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
                    
                    $(".delete").click(function() {;
                        table = $(this).data("table");
                        url = $(this).data("url");
                        sweetalert2(table,url);
                    })
                    
                    $(".toggle-class").bootstrapToggle();
                    $(".toggle-class").change(function() {
                        var active = $(this).prop("checked") == true ? "y" : "n";
                        var id = $(this).data("id");

                        $.ajax({
                            type: "GET",
                            dataType: "json",
                            url: "/changeStatus",
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
            Column::make('space_id')->title('Space'),
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
        return 'Ad_' . date('YmdHis');
    }
}
