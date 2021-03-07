<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateAttractionRequest as Create;
use App\Repositories\Attraction\AttractionRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Province\ProvinceRepository;
use Illuminate\Http\Request;

class AttractionController extends Controller
{
    protected $attractionRepository;
    protected $categoryRepository;
    protected $provinceRepository;

    public function __construct(
        AttractionRepository $attractionRepository,
        CategoryRepository $categoryRepository,
        ProvinceRepository $provinceRepository
    )
    {
        $this->attractionRepository = $attractionRepository;
        $this->categoryRepository = $categoryRepository;
        $this->provinceRepository = $provinceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attractions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        $provinces = $this->provinceRepository->all();

        return view('admin.attractions.create', compact('categories','provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Create $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Create $request)
    {
        $attraction = $this->attractionRepository->createAttraction($request->validated());
        $this->attractionRepository->updateAttractionImages($request->images, $attraction->id);

        return redirect()->back()->with('success', 'Tạo địa điểm thành công');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
