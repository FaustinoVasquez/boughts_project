<?php

namespace App\Http\Controllers\CleanLaunch;

use App\Clean;
use App\Http\Requests\Clean\createCleanRequest;
use App\Http\Requests\Clean\updateCleanRequest;
use App\Sku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CleanLaunchController extends Controller
{
    public function index($sku='')
    {
        return view('clean.index', [
            'view' => 'CleanLaunch',
            'page_title' => 'Clean Launch',
            'sku'=> $sku
        ]);
    }

    public function getData(Request $request)
    {

        return datatables()->of(Clean::query())
            ->setRowId(function ($data) {
                return $data->ID;
            })
            ->make(true);
    }

    public function getSku()
    {
        return Sku::select('SKU')->get();
    }

    public function getBrand()
    {
        return Sku::select('Manufacturer')->distinct()->get();
    }

    public function getPartNumber()
    {
        return Clean::select('PartNumber')->distinct()->get();
    }

    public function store(createCleanRequest $request)
    {
       $request->createCleanLaunch();
       return response()->json(['success'=>true, 'msg'=>'The New SKU has been Clean Launched']);
    }


    public function update(updateCleanRequest $request,Clean $clean)
    {
        $request->updateCleanLaunch($clean);
       return response()->json(['success'=>true, 'msg'=>'The information has been updated']);
    }

    public function show($sku='')
    {
        return view('clean.index', [
            'view' => 'CleanLaunch',
            'page_title' => 'Clean Launch',
            'sku'=> $sku
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Clean $clean
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Clean $clean)
    {
        $clean->delete();
        return response()->json(['success'=>true, 'msg'=>'The SKU has been deleted']);
    }

}
