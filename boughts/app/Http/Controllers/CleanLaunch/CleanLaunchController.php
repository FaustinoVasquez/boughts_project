<?php

namespace App\Http\Controllers\CleanLaunch;

use App\Clean;
use App\Http\Requests\Clean\createCleanRequest;
use App\Http\Requests\Clean\updateCleanRequest;
use App\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        // DEPRECATED: Returns empty array - use searchSkus() instead for AJAX
        return [];
    }

    /**
     * AJAX endpoint for SKU search
     * Used by Select2 dropdowns
     */
    public function searchSkus(Request $request)
    {
        $term = $request->get('term', '');
        $page = $request->get('page', 1);
        $perPage = 20;

        $query = Sku::select('SKU')
            ->orderBy('SKU', 'ASC');

        if ($term) {
            $query->where('SKU', 'LIKE', $term . '%');
        }

        $total = $query->count();
        $skus = $query->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();

        return response()->json([
            'results' => $skus->map(function($sku) {
                return ['id' => $sku->SKU, 'text' => $sku->SKU];
            }),
            'pagination' => [
                'more' => ($page * $perPage) < $total
            ]
        ]);
    }

    public function getBrand()
    {
        // OPTIMIZED: Cache manufacturers for 1 hour
        return Cache::remember('manufacturers_list', 3600, function() {
            return Sku::select('Manufacturer')->distinct()->get();
        });
    }

    public function getPartNumber()
    {
        // OPTIMIZED: Cache part numbers for 1 hour
        return Cache::remember('partnumbers_list', 3600, function() {
            return Clean::select('PartNumber')->distinct()->get();
        });
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
