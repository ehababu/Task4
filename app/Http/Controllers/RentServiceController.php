<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\RentService;
use App\Models\Water;
use App\Models\Generator;
use App\Models\Service;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreRentServiceRequest;

use PDF;
// use TCPDF;


class RentServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $rentService = RentService::all();
        $services = Service::all();
        $rentService = RentService::when($request->searchId, function ($q) use ($request) {
            return $q->where('order_id', $request->searchId);
        })->when($request->searchService && $request->searchService != 'all', function ($q) use ($request) {
            return $q->where('service_id', $request->searchService);
        })->when($request->searchName, function ($q) use ($request) {
            return $q->where('name', 'like', '%' . $request->searchName . '%');
        })->when($request->startDateSearch && $request->endDateSearch, function ($q) use ($request) {
            return $q->where('order_date', '<=', $request->endDateSearch)
                ->where('order_date', '>=', $request->startDateSearch);
        })->get();
        return response()->view('rentservicess.index', compact('rentService', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::get();
        return response()->view('rentservicess.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRentServiceRequest $request)
    {
        //
        $rentService = new RentService();
        $rentService->name = $request->input('name');
        $rentService->order_date = now();
        $rentService->id_num = $request->input('id_num');
        $rentService->mobile_num = $request->input('mobile_num');
        $rentService->category = $request->input('category');
        $rentService->service_id = $request->input('name_service');
        $rentService->start_date = $request->input('start_date');
        $rentService->expiry_date = $request->input('expiry_date');


        if ($request->input('category') == 'صالة') {

            if ($request->input('num_attendees') != null && $request->input('additional_services') != null) {
                $isSaved = $rentService->save();
                $ID = $rentService->order_id;
                $hall = new Hall();
                $hall->service_id = $ID;
                $hall->num_attendees = $request->input('num_attendees');
                $hall->additional_services = $request->input('additional_services');
                $isSaved = $hall->save();
            } else {

                return response()->json([
                    'message' => 'يجب ادخال البيانات '
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            $isSaved = $rentService->save();
        }



        if ($request->input('category') == 'مولد') {


            if ($request->input('add_generator') != null && $request->input('subscription') != null && $request->input('amps') != null) {
                $isSaved = $rentService->save();
                $ID = $rentService->order_id;
                $generator = new Generator();
                $generator->service_id = $ID;
                $generator->add_generator = $request->input('add_generator');
                $generator->subscription = $request->input('subscription');
                $generator->amps = $request->input('amps');
                $isSaved = $generator->save();
            } else {
                return response()->json([
                    'message' => 'يجب ادخال البيانات '
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            $isSaved = $rentService->save();
        }

        if ($request->input('category') == 'مياه') {

            if ($request->input('add_water') != null && $request->input('required_quantity') != null) {
                $isSaved = $rentService->save();
                $ID = $rentService->order_id;
                $water = new Water();
                $water->service_id = $ID;
                $water->add_water = $request->input('add_water');
                $water->required_quantity = $request->input('required_quantity');
                $isSaved = $water->save();
            } else {
                return response()->json([
                    'message' => 'يجب ادخال البيانات '
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            $isSaved = $rentService->save();
        }

        $isSaved = $rentService->save();

        return response()->json([
            'message' => $isSaved ? 'تم انشاء الخدمة بنجاح !' : 'فشل انشاء خدمة, يرجى المحاولة مرة أخرى.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RentService  $rentService
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $rentService = RentService::findOrFail($id);
        return response()->view('rentservicess.show', compact('rentService'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RentService  $rentService
     * @return \Illuminate\Http\Response
     */
    public function edit(RentService $rentService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RentService  $rentService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RentService $rentService)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RentService  $rentService
     * @return \Illuminate\Http\Response
     */
    public function destroy(RentService $rentService)
    {
        //
    }

    public function responseOffer(RentService $rentService, Request $request)
    {

        $rentService->status = $request->input('status');
        $isSaved = $rentService->save();
        return response()->json([
            'message' => $isSaved ? 'تمت العملية بنجاح' : 'فشلت العملية',
        ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function serviceData(Service $service)
    {
        return response()->json([
            'cost_amount' => $service->cost_amount,
            'cost_type' => $service->cost_type,
            'coin' => $service->coin->name,
        ]);
    }

    public function toPdf(RentService $rentService)
    {

        PDF::SetTitle('Service rental data (' . $rentService->name . ')');
        PDF::AddPage();
        PDF::SetFont('aealarabiya', '', 18);
        // PDF::Write( 'Hello World');
        // PDF::Write(0, 'Hello World');
        // PDF::Write(0, 'Hello World');
        // PDF::Write(0, 'Hello World');
        PDF::Write(0, 'Order Id: ' . $rentService->order_id);
        PDF::Ln();
        PDF::Write(0, 'Order Date: ' . $rentService->order_date);
        PDF::Ln();
        PDF::Write(0, 'Order Name: ' . $rentService->name);
        PDF::Ln();
        PDF::Write(0, 'Service Name: ' . $rentService->service->name);
        PDF::Ln();
        PDF::Write(0, 'Category: ' . $rentService->service->main_classification);
        PDF::Ln();
        PDF::Write(0, 'Cost Price: ' . $rentService->cost_price);
        PDF::Ln();
        PDF::Write(0, 'Coin: ' . $rentService->service->coin->name);
        PDF::Ln();
        PDF::Write(0, 'Start Date: ' . $rentService->start_date);
        PDF::Ln();
        PDF::Write(0, 'End Date: ' . $rentService->expiry_date);
        PDF::Ln();
        PDF::Write(0, 'Status: ' . $rentService->status);
        PDF::Ln();
        PDF::Output($rentService->name . '.pdf');
    }
}
