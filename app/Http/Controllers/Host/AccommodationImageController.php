<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\AccommodationImage;
use App\Repositories\AccommodationImage\AccommodationImageRepository;
use Illuminate\Http\Request;

class AccommodationImageController extends Controller
{
    protected $accommodationImageRepository;

    public function __construct(AccommodationImageRepository $accommodationImageRepository)
    {
        $this->accommodationImageRepository = $accommodationImageRepository;
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
     * @param  \App\Models\AccommodationImage  $accommodationImage
     * @return \Illuminate\Http\Response
     */
    public function show(AccommodationImage $accommodationImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccommodationImage  $accommodationImage
     * @return \Illuminate\Http\Response
     */
    public function edit(AccommodationImage $accommodationImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AccommodationImage  $accommodationImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AccommodationImage $accommodationImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccommodationImage  $accommodationImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccommodationImage $accommodationImage)
    {
        $this->accommodationImageRepository->removeAccommodationImage($accommodationImage->id);

        return redirect()->back()->with('success', 'Xóa ảnh thành công');
    }
}
