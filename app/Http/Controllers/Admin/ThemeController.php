<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function activated(Request $request)
    {
        Setting::where('name', 'current_theme')->update(['value' => $request->theme]);
        Setting::where('name', 'current_theme_dir')->update(['value' => $request->theme_dir]);
        return $request->session()->flash('success', 'Theme successfully activated');
    }

    public function theme()
    {
        $theme = request('theme');
        return Settings::get_theme(last(explode('/', $theme)));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $dirs = glob('themes/*' , GLOB_ONLYDIR);
        return view('admin.theme.index', compact('dirs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
