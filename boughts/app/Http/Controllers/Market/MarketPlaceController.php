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
        return Sku::select('SKU')->orderBy('SKU','ASC')->get();
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
            'sku' => Sku::select('SKU')->orderBy('SKU','ASC')->get()
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

        foreach ($request->ids as $id){
            $mkt = Mkt::find($id);
            $mkt->Floor = $request->bulkFloorPrice;
            $mkt->Ceiling = $request->bulkCeilingPrice;
            $mkt->save();
        }

        return response()->json(['success'=>true, 'msg'=>'The skus has been updated']);

    }

    public function deleteBulkPrice(Request $request)
    {
        foreach ($request->ids as $id){
            $mkt = Mkt::find($id);

           // if($mkt->DumpIt){
                $mkt->delete();
          //  }

        }

        return response()->json(['success'=>true, 'msg'=>'The SKUs has been deleted']);

    }

}
