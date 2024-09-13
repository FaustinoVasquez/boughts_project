<?php

namespace App\Http\Controllers\Updates;

use App\Exports\AliasImportExport;
use App\Exports\ProductImportExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ShipStationController extends Controller
{
    public function productImport()
    {
        $filename = 'productImport_'.Carbon::now()->format('y-m-d_h-i-s').'.csv';
        return Excel::download(new ProductImportExport, $filename, \Maatwebsite\Excel\Excel::CSV);
    }

    public function aliasImport()
    {
        $filename = 'aliasImport_'.Carbon::now()->format('y-m-d_h-i-s').'.csv';
        return Excel::download(new AliasImportExport, $filename, \Maatwebsite\Excel\Excel::CSV);
    }
}
