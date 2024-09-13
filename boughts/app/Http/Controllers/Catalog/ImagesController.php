<?php

namespace App\Http\Controllers\Catalog;

use App\Image;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'pictureFile' =>
                'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'id'=> 'required', //'id' or 'sku'
            'name'=> 'required',  //129552-002 or RMTC05058-001
            'url'=> 'required',  //http://remotespict.mitechnologiesinc.com
            'item'=> 'required',  //129552 or RMTC05058
        ]);

        if ($request->id === 'id'){
            $image = Image::find($request->item);
            $path = $image->SKU.'/'.$image->name;
        }else{
            $path = $request->item.'/'.$request->name.'.jpg';
            $image = Image::create([
                'SKU' => $request->item,
                'URL' => $request->url.'/'.$request->item.'/'.$request->name.'.jpg',
                'name' => $request->name.'.jpg',
                'ImageExists'=> 1,
                'ImageExistsStamp' => now()
            ]);
        }
	
       $ret = Storage::disk('sftp')->put($path, fopen($request->file('pictureFile'), 'rw+'));

        return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param Sku $sku
     * @return
     */
    public function show($id)
    {
        $images = Image::where('SKU',$id)->get();
        $arrImage=[];

        for ($i = 0; $i < 20; $i++) {
            $j=$i+1;
            $arrImage[$i]=['SKU'=> $id,
		  'URL'=> env('PHOTOS_URL')."/no_image.png",
            //    'URL'=> "http://remotespict.mitechnologiesinc.com/no_image.png",
                'ImageExists'=> false,
            ];
            if($i<=9){
                $arrImage[$i]['name'] = $id. '-00'.$j;
            }else{
                $arrImage[$i]['name'] = $id. '-0'.$j;
            }
        }

        foreach ($images as $key => $value){
            $myId = (int) explode('-', $value->name)[1];
            $arrImage[$myId - 1] = $value;

        }

        return $arrImage;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,Image $image)
    {
        $this->validate($request,[
           'pictureFile' =>
               'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'number'=>'required'
       ]);

        $path = $image->SKU.'/'.$image->name;
        $num = $request->number;


        Storage::disk('sftp')->put($path, fopen($request->file('pictureFile'), 'r+'));

        return response()->json([
            'message' => 'Image Upload Sucessfully',
            'image' => "image-{$num}",
            'imageSrc' =>$image->URL,
            'input' => "input-{$num}",
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Image $image)
    {
        $file = $image->SKU.'/'.$image->name;
        $image->delete();

        Storage::disk('sftp')->delete($file);

        return response()->json(['success'=>true, 'msg'=>'The Image has been deleted']);
    }
}
