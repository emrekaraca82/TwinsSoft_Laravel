<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliderList = Slider::get() ?? abort(404,'Sayfa bulunamadı');
        return view("admin.slider.index",compact('sliderList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {      
        return view('admin.slider.create');     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('SliderGorsel')){
            $fileName = Str::slug($request->SliderBaslik).'.'.$request->SliderGorsel->extension();
            $fileNameWithUpload = 'uploads/slider/'.$fileName;
            $request->SliderGorsel->move(public_path('uploads/slider'),$fileName);
            $request->merge([
                'SliderGorsel'=>$fileNameWithUpload
            ]);
        }

        Slider::create($request->post());
        return redirect()->route('slider.index')->withSuccess('Slider Başarıyıla Eklendi');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id) ?? abort(404,'Quiz Bulunamadı');  
        return view('admin.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->hasFile('SliderGorsel')){
            $fileName = Str::slug($request->SliderBaslik).'.'.$request->SliderGorsel->extension();
            $fileNameWithUpload = 'uploads/slider/'.$fileName;
            $request->SliderGorsel->move(public_path('uploads/slider'),$fileName);
            $request->merge([
                'SliderGorsel'=>$fileNameWithUpload
            ]);
        }

        Slider::find($id)->first()->update($request->post());
        return redirect()->route('slider.index',$id)->withSuccess('Slider başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        Slider::find($id)->delete();
        return redirect()->route('slider.index')->withSuccess('İlgili veri başarıyla silindi');
    }
}
