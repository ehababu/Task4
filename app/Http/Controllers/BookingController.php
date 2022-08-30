<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RentService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreBookingRequest;



class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return response()->view('bookings.index', compact('bookings'));
    }
    public function indexChart()
    {
        return view('bookings.charts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RentService $rentService)
    {
        return response()->view('bookings.create', compact('rentService'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RentService $rentService, StoreBookingRequest $request)
    {
        //
        $bookings = new Booking();
        $bookings->order_date = now();
        $bookings->start_date = $request->input('start_date');
        $bookings->expiry_date = $request->input('expiry_date');
        $bookings->rentservice_id = $rentService->order_id;
        $isSaved = $bookings->save();
        if($isSaved) {
            $rentService->status = 'محجوز';
            $rentService->save();
        }

        return response()->json([
            'message' => $isSaved ? 'تم حجز الخدمة بنجاح !' : 'فشل حجز الخدمة, يرجى المحاولة مرة أخرى.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

 
    public function sumService(){

        $bulliding = 0;
        $count=0;
        $halls=0; 
        $water=0;
        $genrator=0;

        

    }
    
}