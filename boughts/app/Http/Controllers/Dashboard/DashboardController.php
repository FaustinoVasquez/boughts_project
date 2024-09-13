<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('dashboard.index',[
            'view' => 'dashboard',
            'page_title' => 'Dashboard'
        ]);
    }

    public function getData(Request $request)
    {
        $this->validate($request,[
            'condition'=>['required'],
            'days'=>['required'],
        ]);

        $data = DB::select("EXEC sp_GetRunRates {$request->days}, '{$request->condition}'");

        return datatables()
            ->of($data)
            ->setRowId(function ($data) {
                return $data->SKU;
            })
            ->make(true);
    }
}
