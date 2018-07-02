<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var Carbon
     */
    protected $now;

    public function __construct()
    {
//        $this->middleware(
//            function (Request $request, Closure $next) {
//                $this->now = Carbon::now();
//                view()->share('now', $this->now);
//
//                return $next($request);
//            }
//        );
    }
}
