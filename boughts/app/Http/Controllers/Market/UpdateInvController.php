<?php

namespace App\Http\Controllers\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UpdateInvController extends Controller
{
    public function index()
    {
        $data = DB::select("EXEC [Remotes].[dbo].[sp_PWRepricerFeed] Update  Repricer ");
        return response()->json(['success'=>true, 'msg'=>'The update process has started']);
    }
}
