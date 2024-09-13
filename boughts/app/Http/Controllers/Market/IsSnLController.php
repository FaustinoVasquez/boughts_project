<?php

namespace App\Http\Controllers\Market;

use App\Mkt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class IsSnLController extends Controller
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
            'IsSnL'=>['required',Rule::in(['true','false'])],
        ]);

        $mkt->update(['IsSnL' => $request->IsSnL]);

        return response()->json(['success'=>true, 'msg'=>'The information has been updated']);
    }
}
