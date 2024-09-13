<?php

namespace App\Http\Controllers\Market;

use App\Mkt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class CeilingController extends Controller
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

        $this->validate($request,[
            'Ceiling'=>['required','numeric','between:0,999.99'],
        ]);

        $mkt->update(['Ceiling' => $request->Ceiling]);

        return response()->json(['success'=>true, 'msg'=>'The information has been updated']);

    }
}
