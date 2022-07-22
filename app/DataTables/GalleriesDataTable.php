<?php

namespace App\DataTables;

use App\Models\Post;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class GalleriesDataTable extends DataTable
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
            ->addColumn('post_author', function ($query) {
                return $query->user->name;
            })
            ->addColumn('action', function ($query) {
                return view('layouts.partials._action', [
                    'table' => 'gallery-table',
                    'model' => $query,
                    'del_url' => route('galleries.destroy', $query->id),
                    'edit_url' => route('galleries.edit', $query->id)
                ]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Post $model)
    {
        return Post::where('post_type', 'gallery')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('gallery-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>")
            ->orderBy(1)
            ->parameters([
                'drawCallback' => 'function() {
                    $(".delete").click(function() {
                        table = $(this).data("table");
                        url = $(this).data("url");
                        sweetalert2(table,url);
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
            Column::make('post_title')->title('File'),
            Column::make('post_author')->title('Author'),
            Column::make('post_mime_type')->title('Type'),
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
        return 'Gallery_' . date('YmdHis');
    }
}
