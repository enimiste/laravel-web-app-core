<?php

namespace Enimiste\LaravelWebApp\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

abstract class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $type
     * @param string $msg
     */
    public function flash($type, $msg)
    {
        $notices = Session::get('notices', []);
        $notices[$type][] = $msg;
        Session::flash('notices', $notices);
    }
}
