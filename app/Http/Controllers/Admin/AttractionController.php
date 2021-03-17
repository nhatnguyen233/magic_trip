<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Attraction\CreateAttraction as Create;
use App\Http\Requests\Admin\Attraction\UpdateAttraction as Update;
use App\Models\Attraction;
use App\Repositories\Attraction\AttractionRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Province\ProvinceRepository;

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
        $attractions = $this->attractionRepository->all();

        return view('admin.attractions.index', compact('attractions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->findWhere(['type' => 2]);
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
        if($request->images) {
            $this->attractionRepository->updateAttractionImages($request->images, $attraction->id, auth('admin')->id());
        }

        return redirect()->route('admin.attractions.index')->with('success', 'Tạo địa điểm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function show(Attraction $attraction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function edit(Attraction $attraction)
    {
        $categories = $this->categoryRepository->findWhere(['type' => 2]);
        $provinces = $this->provinceRepository->all();

        return view('admin.attractions.edit', compact('attraction', 'categories', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function update(Update $request, Attraction $attraction)
    {
        $this->attractionRepository->updateAttraction($request->validated(),$attraction->id);
        if($request->images) {
            $this->attractionRepository->updateAttractionImages($request->images, $attraction->id, auth('admin')->id());
        }

        return redirect()->route('admin.attractions.index')->with('success', 'Cập nhật địa điểm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Attraction  $attraction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attraction $attraction)
    {
        $this->attractionRepository->removeAttraction($attraction->id);

        return redirect()->back()->with('success', 'Xóa địa điểm thành công');
    }
}
