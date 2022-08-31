<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\RentService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Service;

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
        $buildings_count = RentService::where('category', 'مباني')->count();
        $water_count = RentService::where('category', 'مياه')->count();
        $halls_count = RentService::where('category', 'صالة')->count();
        $generators_count = RentService::where('category', 'مولد')->count();
        $bookings_buildings_count = Booking::whereIn('rentservice_id', $this->getBookingCount('مباني'))->count();
        $bookings_water_count = Booking::whereIn('rentservice_id', $this->getBookingCount('مياه'))->count();
        $bookings_halls_count = Booking::whereIn('rentservice_id', $this->getBookingCount('صالة'))->count();
        $bookings_generators_count = Booking::whereIn('rentservice_id', $this->getBookingCount('مولد'))->count();
        return view('bookings.charts', compact(
            'buildings_count',
            'water_count',
            'halls_count',
            'generators_count',
            'bookings_buildings_count',
            'bookings_water_count',
            'bookings_halls_count',
            'bookings_generators_count',
        ));
    }

    private function getBookingCount(string $category)
    {
        return RentService::where('category', $category)->get('order_id')->toArray();
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
        if ($isSaved) {
            $rentService->status = 'محجوز';
            $rentService->save();
        }

        return response()->json([
            'message' => $isSaved ? 'تم حجز الخدمة بنجاح !' : 'فشل حجز الخدمة, يرجى المحاولة مرة أخرى.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }


 
}