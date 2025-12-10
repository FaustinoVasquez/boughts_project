<?php

namespace App\Http\Controllers\Market;

use App\Http\Requests\Market\CreateMarketRequest;
use App\Http\Requests\Market\UpdateMarketRequest;
use App\Mkt;
use App\Sku;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MarketPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('market.index', [
            'view' => 'Market Place',
            'page_title' => 'Market Place Mapping',
        ]);
    }

    public function getData(Request $request)
    {
       $data = Mkt::query();

       return datatables()->eloquent($data)
           ->filter(function ($query) use ($request){
                 if ($condition = $request->hasCondition) {
                     $query->where('Condition', $condition);
                }
               if ($fullfillment = $request->hasFulfillment) {
                   $query->where('FulfillmentType', "{$fullfillment}");
               }
               if ($isCN = $request->isCN) {
                   $query->where('IsCN', "{$isCN}");
               }
        },true)
           ->setRowId(function ($data) {
                return $data->ID;
            })
           ->addColumn('DontDel', 0)
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateMarketRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateMarketRequest $request)
    {
        $mkt = new Mkt();
        $request->crateMKT($mkt);
        return response()->json([
            'success'=>true,
            'msg'=>'The new market place mapping has been created'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param Mkt $mkt
     * @return
     */
    public function show(Mkt $mkt)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Mkt $mkt
     * @return array
     */
    public function edit(Mkt $mkt)
    {
       return  $data=[
            'market'=> $mkt,
            // OPTIMIZED: Don't load all SKUs - use AJAX search instead
            'sku' => []
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMarketRequest $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMarketRequest $request, $id=null)
    {

        $mkt =$request->updateMKT($id);

        return response()->json([
            'success'=>true,
            'msg'=>'The information has been updated',
            'merchantSku' => $mkt->getNewMerchantSKU($mkt->SKU)
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mkt $mkt
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Mkt $mkt)
    {
        $mkt->delete();
        return response()->json(['success'=>true, 'msg'=>'The SKU Mapping has been deleted']);

    }

    public function getMS($sku)
    {
        $mkt = new Mkt;
        return response()->json($mkt->getNewMerchantSKU($sku));
    }


    public function updateBulkPrice(Request $request)
    {
        $this->validate($request,[
            'bulkFloorPrice'=>[
                'required','numeric','min:0','lte:bulkCeilingPrice'
            ],
            'bulkCeilingPrice'=>['required'],
            'ids' =>['required']
        ]);

        // OPTIMIZED: Use single query instead of N queries (N+1 fix)
        Mkt::whereIn('ID', $request->ids)->update([
            'Floor' => $request->bulkFloorPrice,
            'Ceiling' => $request->bulkCeilingPrice
        ]);

        return response()->json(['success'=>true, 'msg'=>'The skus has been updated']);

    }

    public function deleteBulkPrice(Request $request)
    {
        // OPTIMIZED: Use single query instead of N queries (N+1 fix)
        Mkt::whereIn('ID', $request->ids)->delete();

        return response()->json(['success'=>true, 'msg'=>'The SKUs has been deleted']);

    }

}
