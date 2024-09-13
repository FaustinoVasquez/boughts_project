<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class ProductImportExport implements FromView
{

    public function view(): View
    {
        return view('shipStation.productImport',[
            'productsImport' => DB::select("EXEC [Remotes].[dbo].[sp_ShipstationProductImport]")
        ]);
    }
}
