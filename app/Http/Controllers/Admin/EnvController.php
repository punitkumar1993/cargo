<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnvController extends Controller
{
    /**
     * Upload a .env-file and replace the current one
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function upload(Request $request)
    {
        $file = $request->file('backup');
        $file->move(base_path(), '.env');
        return redirect(config('dotenveditor.route.prefix'));
    }
}
