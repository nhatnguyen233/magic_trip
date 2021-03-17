<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accommodation;
use App\Repositories\Accommodation\AccommodationRepository;
use App\Repositories\Province\ProvinceRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Accommodation\IndexAccommodation as Index;
use App\Http\Requests\Admin\Accommodation\CreateAccommodation as Create;

class AccommodationController extends Controller
{
    protected $accommodationRepository;
    protected $provinceRepository;

    public function __construct(
        AccommodationRepository $accommodationRepository,
        ProvinceRepository $provinceRepository
    )
    {
        $this->accommodationRepository = $accommodationRepository;
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Index $request)
    {
        $accommodations = $this->accommodationRepository->all();

        return view('admin.accommodations.index', compact('accommodations'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = $this->provinceRepository->all();

        return view('admin.accommodations.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Create $request
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {
        $accommodation = $this->accommodationRepository->createAccommodation($request->validated());
        if($request->images)
        {
            $this->accommodationRepository->insertAccommodationImages($request->images, $accommodation->id, auth('admin')->id());
        }

        return redirect()->route('admin.accommodations.index')->with('success', 'Tạo địa điểm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function show(Accommodation $accommodation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function edit(Accommodation $accommodation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accommodation  $accommodation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accommodation $accommodation)
    {
        //
    }
}
