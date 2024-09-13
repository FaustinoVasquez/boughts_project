<?php

namespace App\Http\Controllers\Catalog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ActionsController extends Controller
{
    public function inventory(Request $request)
    {
        DB::select("EXEC [Remotes].[dbo].[sp_PWUpdateInventory]");
        return response()->json(['success'=>true, 'msg'=>'The Inventory has been Updated']);
    }

    public function repricer(Request $request)
    {
       DB::select("EXEC [Remotes].[dbo].[sp_PWRepricerFeed]");
        return response()->json(['success'=>true, 'msg'=>'The Repricer has been Updated']);
    }

    public function launchInv(Request $request)
    {
        DB::select("EXEC [Remotes].[dbo].[sp_PWLaunchItems]");
        return response()->json(['success'=>true, 'msg'=>'The Inventory has been Launched']);
    }
}
