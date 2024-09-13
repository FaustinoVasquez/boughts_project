<?php

namespace App\Http\Controllers\Market;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LaunchController extends Controller
{
    public function index()
    {
        $data = DB::select("EXEC [Remotes].[dbo].[sp_PWLaunchItems] Launch");
        return response()->json(['success'=>true, 'msg'=>'The launch items process has started']);
   }
}
