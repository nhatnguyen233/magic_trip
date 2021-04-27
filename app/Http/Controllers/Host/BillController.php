<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bill\GetList;
use App\Models\Bill;
use App\Repositories\Bill\BillRepository;
use App\Support\Collection;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class BillController extends Controller
{
    protected $billRepository;

    public function __construct(BillRepository $billRepository)
    {
        $this->billRepository = $billRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  GetList  $request
     * @return \Illuminate\Http\Response
     */
    public function index(GetList $request)
    {
        $viewData['bills'] = (new Collection($this->billRepository->getList($request->validated(), auth('host')->user()->host->id)))->sortByDesc('created_at')->paginate(10);

        return view('host.bills.index', $viewData);
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
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill  $bill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill $bill)
    {
        //
    }

    /**
     * Get list to export PDF.
     *
     * @param  GetList  $request
     * @return \Illuminate\Http\Response
     */
    public function getListToExport(GetList $request) {
        $viewData['bills'] = (new Collection($this->billRepository->getList($request->validated(), auth('host')->user()->host->id)))->sortByDesc('created_at')->paginate(10);

        return view('host.bills.export', $viewData);
    }

    /**
     * Export PDF.
     *
     * @param  GetList  $request
     * @return \Illuminate\Http\Response
     */
    public function createPDF(GetList $request) {
        $data['bills'] = (new Collection($this->billRepository->getList($request->validated(), auth('host')->user()->host->id)))->sortByDesc('created_at')->paginate(10);
        $pdf = PDF::loadView('host.bills.export', $data)->setOptions(['defaultFont' => 'sans-serif']);

        return $pdf->download('bill.pdf');
    }
}
