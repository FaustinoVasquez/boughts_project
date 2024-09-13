<?php

namespace App\Http\Controllers\Inventory;

use App\Category;
use App\InvGlobal;
use App\Sku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;


class GlobalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::orderBy('CategoryID','ASC')->get();
        $partNumbers =Sku::groupBy('Manufacturer')->pluck('Manufacturer');

        return view('inventory.index', [
            'view' => 'Inventory Global',
            'page_title' => 'Inventory Global',
            'categories' => $categories,
            'partNumbers' => $partNumbers,
        ]);

    }

    public function getData(Request $request)
    {
        $data = InvGlobal::query();


        return Datatables::of($data)->filter(function($query) use($request) {
                    if($manufacturer = $request->manufacturer){
                        $query->where('Manufacturer',$manufacturer);
                    }
                    if($category = $request->category){
                        $query->where('CategoryName',$category);
                    }
                    if($isCn = $request->isCn){
                        $query->where('CNQty','>',0);
                    }
                    if($hasInventory = $request->hasInventory){
                        $query->where(function($q){
                            $q->where('CNQty','>',0)
                                ->OrWhere('NewQty','>',0)
                                ->OrWhere('UsedQty','>',0)
                                ->OrWhere('CNQty','>',0)
                                ->OrWhere('NoCoverQty','>',0)
                                ->OrWhere('DENewQty','>',0)
                                ->OrWhere('DEUsedQty','>',0)
                                ->OrWhere('DECNQty','>',0);
                        });
                    }

                },true)
            ->addIndexColumn()
            ->setRowId(function ($data) {
                return $data->SKU;
            })
            ->make(true);
    }

}
