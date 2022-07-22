<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
                    <input type="checkbox" class="custom-control-input user_checkbox" id="checkbox'.$query->id.'" name="user_checkbox[]" value="'.$query->id.'"><label class="custom-control-label" for="checkbox'.$query->id.'"></label>
                </div>';
            })
            ->addColumn('roles', function($query) {
                foreach ($query->getRoleNames() as $role) {
                    $roles[] =  "<small class='badge badge-success'>$role</small>";
                }
                return implode(' ', $roles);
            })
            ->addColumn('action', function ($query) {
                $action = [
                    'table' => 'user-table',
                    'model' => $query,
                ];

                if (Auth::User()->hasAnyRole(['superadmin'])) {
                    if (User::findOrFail($query->id)->getRoleNames()->first() === 'superadmin') {
                        if(Auth::id() == $query->id){
                            $action['del_url'] = route('users.destroy', $query->id);
                            $action['edit_url'] = route('users.edit', $query->id);
                        }
                    } else {
                        if (Auth::id() == $query->id) {
                            $action['del_url'] = route('users.destroy', $query->id);
                            $action['edit_url'] = route('users.edit', $query->id);
                        } else {
                            $action['del_url'] = route('users.destroy', $query->id);
                            $action['edit_url'] = route('users.edit', $query->id);
                        }
                    }
                } elseif (Auth::User()->hasRole(['admin'])) {
                    if (User::findOrFail($query->id)->getRoleNames()->first() != 'superadmin') {
                        $action['del_url'] = route('users.destroy', $query->id);
                        $action['edit_url'] = route('users.edit', $query->id);
                    } else {
                        if(Auth::id() == $query->id){
                            $action['del_url'] = route('users.destroy', $query->id);
                            $action['edit_url'] = route('users.edit', $query->id);
                        }
                    }
                } else {
                    if (User::findOrFail($query->id)->getRoleNames()->first() != 'superadmin' OR 'admin') {
                        $action['del_url'] = route('users.destroy', $query->id);
                        $action['edit_url'] = route('users.edit', $query->id);
                    } else {
                        if(Auth::id() == $query->id){
                            $action['del_url'] = route('users.destroy', $query->id);
                            $action['edit_url'] = route('users.edit', $query->id);
                        }
                    }
                }
                return view('layouts.partials._action', $action);
            })
            ->rawColumns(['roles','checkbox']);;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        if (Auth::User()->hasRole('superadmin')) {
            return User::with('roles')->latest()->newQuery();
        } else if (Auth::User()->hasRole('admin')){
            return User::notRole(['superadmin'])->with('roles')->latest()->newQuery();
        } else {
            return User::notRole(['superadmin','admin'])->with('roles')->latest()->newQuery();
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
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
                    "use strict";

                    $(".delete").on("click", function() {
                        let table = $(this).data("table");
                        let url = $(this).data("url");
                        sweetalert2(table, url);
                    })

                    $("#bulk_delete").on("click", function() {
                        let url = $(this).data("url");
                        let table = "user-table";
                        let selectClass = "user_checkbox";
                        multiDelCheckbox(table, url, selectClass);
                    })

                    $("#selectAll").on("click", function(e) {
                        if ($(this).is( ":checked" )) {
                            $(".user_checkbox").prop("checked",true);
                        } else {
                            $(".user_checkbox").prop("checked",false);
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
            Column::make('name')
                ->footer('<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn btn-xs btn-danger" data-url="'.route('users.massdestroy').'">Delete</button>'),
            Column::make('email'),
            Column::make('organization'),
            Column::make('roles'),
            Column::computed('action')
                ->addClass('text-center')
                ->width(60),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
