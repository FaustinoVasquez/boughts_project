<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class AliasImportExport implements FromView
{

    public function view(): View
    {
        return view('shipStation.aliasImport', [
            'aliasesImport' => DB::select("EXEC [Remotes].[dbo].[sp_ShipstationAliasImport]")
        ]);
    }

}
