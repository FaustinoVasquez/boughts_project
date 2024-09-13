<?php

namespace App\Http\Controllers\Market;

use App\Mkt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FloorController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Mkt $mkt
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Mkt $mkt)
    {

        $ceiling = $mkt->Ceiling;

        $this->validate($request,[
            'Floor'=>['required','numeric','between:0,999.99','lte:'.$ceiling],
        ]);

        $mkt->update(['Floor' => $request->Floor]);

        return response()->json(['success'=>true, 'msg'=>'The information has been updated']);

    }
}
