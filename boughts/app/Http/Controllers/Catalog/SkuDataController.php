<?php

namespace App\Http\Controllers\Catalog;

use App\BinHistory;
use App\BinStock;
use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\CreateSkuDataRequest;
use App\Http\Requests\UpdateCNPricesSkuDataRequest;
use App\Http\Requests\UpdateNewPricesSkuDataRequest;
use App\Http\Requests\Catalog\UpdateSkuDataRequest;
use App\Http\Requests\UpdateUsedPricesSkuDataRequest;
use App\Sku;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class SkuDataController extends Controller
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


        return view('catalog.index', [
            'view' => 'SkuData',
            'page_title' => 'Product SkuData',
            'categories' => $categories,
            'partNumbers' => $partNumbers,
        ]);
    }

    public function getData(Request $request)
    {
        $hasCompatibility = ($request->hasCompatibility) ? $request->hasCompatibility : '';
        $manufacturer= ($request->manufacturer)? $request->manufacturer:'';
        $hasCategory= ($request->hasCategory)? $request->hasCategory : 0;
        $hasInventory = ($request->hasInventory=='true') ? 1 :0;
        $researchComplete = $request->researchComplete;
        $isCn =$request->isCn;


        $data = DB::select("EXEC [Remotes].[dbo].[sp_GetSKUDataInfo] 
                            '$hasCompatibility',$hasInventory,'$manufacturer',$hasCategory,$researchComplete,$isCn");

        return datatables()->of($data)
            ->setRowId(function ($data) {
                return $data->SKU;
            })
            ->make(true);

    }

    public function getQtyUSBinStockData($sku)
    {
        $data = BinStock::where('SKU',$sku)->get();

        return datatables()->of($data)->make(true);
    }

    public function getQtyUSBinHistoryData($sku)
    {
        $data = BinHistory::where('SKU',$sku)->get();

        return datatables()->of($data)->make(true);
    }

    public function getQtyEUBinStockData($sku)
    {
        $data = BinStock::where('SKU',$sku)->get();

        return datatables()->of($data)->make(true);
    }

    public function getQtyEUBinHistoryData($sku)
    {
        $data = BinHistory::where('SKU',$sku)->get();

        return datatables()->of($data)->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $categories = Category::orderBy('CategoryID','ASC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSkuDataRequest $request)
    {
        $request->crateSKU();

        return response()->json(['success'=>true, 'msg'=>'The New SKU has been created']);

    }

    /**
     * Display the specified resource.
     *
     * @param Sku $sku
     * @return void
     */
    public function show(Sku $sku)
    {

        $images = $sku->images()->get();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sku $sku
     * @param $column
     * @return array
     */
    public function edit(Sku $sku, $column)
    {
          $data = [
              'sku'=> $sku,
          ];

          if ($column=='sku'){
              $data['categories'] = Category::orderBy('CategoryId','ASC')->get();
          }
      return $data;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSkuDataRequest $request
     * @param Sku $sku
     * @return JsonResponse
     */
    public function update(UpdateSkuDataRequest $request, Sku $sku)
    {
        $request->updateSKU($sku);
        return response()->json(['success'=>true, 'msg'=>'The information has been updated']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNewPricesSkuDataRequest $request
     * @param Sku $sku
     * @return JsonResponse
     */
    public function updateNewPrices(UpdateNewPricesSkuDataRequest $request, Sku $sku)
    {
        $request->updateSKU($sku);
        return response()->json(['success'=>true, 'msg'=>'The information has been updated']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCNPricesSkuDataRequest $request
     * @param Sku $sku
     * @return JsonResponse
     */
    public function updateCNPrices(UpdateCNPricesSkuDataRequest $request, Sku $sku)
    {
        $request->updateSKU($sku);
        return response()->json(['success'=>true, 'msg'=>'The information has been updated']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUsedPricesSkuDataRequest $request
     * @param Sku $sku
     * @return JsonResponse
     */
    public function updateUsedPrices(UpdateUsedPricesSkuDataRequest $request, Sku $sku)
    {
        $request->updateSKU($sku);
        return response()->json(['success'=>true, 'msg'=>'The information has been updated']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Sku $sku
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateHaveCnVariant(Request $request, Sku $sku)
    {
        $this->validate($request,[
            'HaveCNVariant'=>['required',Rule::in(['true','false'])],
        ]);

        $sku->update(['HaveCNVariant' => $request->HaveCNVariant]);

       return response()->json(['success'=>true, 'msg'=>'The information has been updated']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Sku $sku
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Sku $sku)
    {
	if($sku->images){
	  $sku->images->each->delete();	
	}

        $sku->delete();
        return response()->json(['success'=>true, 'msg'=>'The SKU has been deleted']);
    }

    public function cleanTxt(Request $request)
    {
        $this->validate($request,[
            'text'=>['required'],
        ]);

        $data = DB::select("EXEC [Remotes].[dbo].[sp_CSVCleanCompatiblity] '".$request->text."','CleanType1'");

        return response()->json(['success'=>true, 'data'=>$data]);
    }


    public function compareText(Request $request,Sku $sku)
    {
        $this->validate($request,[
            'dataField'=>['required'],
            'nameField'=>['required'],
        ]);
        $fieldForm = $request->nameField;
        $diff = ($request->dataField*100)/strlen($sku->$fieldForm);
        return response()->json(['success'=>true, 'data'=>$diff]);
    }

}
