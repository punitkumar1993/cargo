<?php

namespace App\DataTables;

use App\Models\Term;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TagDataTable extends DataTable
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
                    <input type="checkbox" class="custom-control-input tag_checkbox" id="checkbox'.$query->id.'" name="tag_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
            })
            ->addColumn('action', function ($query) {
                $name = ($query->taxonomy->parent == 0) ? '0' : Term::find($query->taxonomy->parent)->name;
                return view('layouts.partials._action', [
                    'table' => 'tag-table',
                    'model' => collect($query)->merge(['parent_name' => $name]),
                    'del_url' => route('tags.destroy', $query->id),
                    'edit_url' => route('tags.update', $query->id)
                ]);
            })
            ->rawColumns(['action','checkbox']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Tag $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Term $model)
    {
        return Term::whereHas("taxonomy", function ($query) {
            $query->where("taxonomy", "tag");
        })->latest()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('tag-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6'p>>")
            ->orderBy(1)
            ->parameters([
                'drawCallback' => 'function() {
                    "use strict";

                    $(".link-edit").on("click", function(e) {
                        e.preventDefault();
                        let editurl = $(this).attr("href");
                        let query = $(this).data("model");

                        $("#name").val(query.name);
                        $("form#insert").attr("href", editurl);
                        $(".card-form.card-title").html("Update Tag");

                        $("#btn-reset").removeAttr("hidden");
                        $("#btn-submit").attr("id","btn-submit-update");
                        $("button[type=submit]").html("Update");
                    })

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        sweetalert2(table, url);
                    })

                    $("#bulk_delete").on("click", function() {
                        let url = $(this).data("url");
                        let table = "tag-table";
                        let selectClass = "tag_checkbox";
                        multiDelCheckbox(table, url, selectClass);
                    })

                    $("#selectAll").on("click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".tag_checkbox").prop("checked",true);
                        } else {
                            $(".tag_checkbox").prop("checked",false);
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
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="'.route('tags.massdestroy').'">Delete</button>'),
            Column::make('name'),
            Column::make('slug'),
            Column::computed('action')
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
        return 'Tag_' . date('YmdHis');
    }
}
