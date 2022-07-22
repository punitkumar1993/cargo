<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PagesDataTable extends DataTable
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
                    <input type="checkbox" class="custom-control-input page_checkbox" id="checkbox'.$query->id.'" name="page_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
            })
            ->editColumn('post_title', function ($query) {
                return "<a href='" . route('page.show', $query) . "' target='_blank'>" . $query->post_title . "</a>";
            })
            ->addColumn('action', function ($query) {
                return view('layouts.partials._action', [
                    'table' => 'page-table',
                    'model' => $query,
                    'del_url' => route('pages.destroy', $query->id),
                    'edit_url' => route('pages.edit', $query->id)
                ]);
            })
            ->rawColumns(['post_title','checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model)
    {
        return Post::where('post_type', 'page')->with('user')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('page-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'i><'col-sm-12 col-md-4'p>>")
            ->orderBy(1)
            ->buttons(
                Button::make('create')->className('btn btn-sm btn-info')
            )
            ->parameters([
                'drawCallback' => 'function() {
                    $(".delete").click(function() {
                        table = $(this).data("table");
                        url = $(this).data("url");
                        sweetalert2(table,url);
                    })

                    $("#bulk_delete").click(function() {
                        url = $(this).data("url");
                        table = "page-table";
                        selectClass = "page_checkbox";
                        multiDelCheckbox(table,url,selectClass);
                    })

                    $("#selectAll").on( "click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".page_checkbox").prop("checked",true);
                        } else {
                            $(".page_checkbox").prop("checked",false);
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
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="'.route('posts.massdestroy').'">Delete</button>'),
            Column::make('post_title')->title('Title'),
            Column::make('post_name')->title('Slug'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Page_' . date('YmdHis');
    }
}
