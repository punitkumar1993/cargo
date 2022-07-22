<?php

namespace App\DataTables;

use App\Models\Advertisement;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdvertisementsDataTable extends DataTable
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
                return view('admin.advertisement._checked', compact('checked', 'id'));
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
                    }else if ($spaceName == 'home-popup'){
                        return 'Home Popup';
                    }else if ($spaceName == 'sidebar-right-top'){
                        return 'Sidebar Top';
                    }else if ($spaceName == 'sidebar-right-second-top'){
                        return 'Sidebar Second Top';
                    }else if ($spaceName == 'sidebar-right-middle'){
                        return 'Sidebar Middle';
                    }else if ($spaceName == 'sidebar-right-second-middle'){
                        return 'Sidebar Second Middle';
                    }else if ($spaceName == 'sidebar-right-bottom'){
                        return 'Sidebar Bottom';
                    }else if ($spaceName == 'sidebar-right-second-bottom'){
                        return 'Sidebar Second Bottom';
					}else if ($spaceName == 'after-main-slider'){
                        return 'After Main Slider';
                    }else if ($spaceName == 'before-latest-news'){
                        return 'Before Latest News';
                    }else if ($spaceName == 'before-more-news'){
                        return 'Before More News';
                    }else if ($spaceName == 'before-top-categories'){
                        return 'Before Top Categories';
                    }else if ($spaceName == 'before-trending-section'){
                        return 'Before Trending Section';
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
                    'edit_url' => route('advertisement.edit', $query->id)
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
        return $model->where('news_active','n')->with('space')->latest()->newQuery();
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
