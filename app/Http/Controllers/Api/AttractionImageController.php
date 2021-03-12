<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttractionImage;
use Illuminate\Http\Request;
use App\Repositories\AttractionImage\AttractionImageRepository;

class AttractionImageController extends Controller
{
    protected $attractionImageRepository;

    public function __construct(AttractionImageRepository $attractionImageRepository)
    {
        $this->attractionImageRepository = $attractionImageRepository;
    }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttractionImage  $attractionImage
     * @return \Illuminate\Http\Response
     */
    public function show(AttractionImage $attractionImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttractionImage  $attractionImage
     * @return \Illuminate\Http\Response
     */
    public function edit(AttractionImage $attractionImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttractionImage  $attractionImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttractionImage $attractionImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttractionImage  $attractionImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttractionImage $attractionImage)
    {
//        $this->attractionImageRepository->removeAttractionImage($attractionImage->id);
//
//        return response()->json([], 200);
    }
}
