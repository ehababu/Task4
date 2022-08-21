<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Building;
use App\Models\coin;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('category')) {
            if ($request->input('category') != 'all') {
                $services = Service::with('coin')->where('name', 'like', '%' . $request->input('name') . '%')->where('main_classification', $request->input('category'))->get();
            } else {
                $services = Service::with('coin')->where('name', 'like', '%' . $request->input('name') . '%')->get();
            }
        } else {
            $services = Service::with('coin')->where('name', 'like', '%' . $request->input('name') . '%')->get();
        }

        return response()->view('servicess.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $coins = Coin::where('is_active', true)->get();
        return response()->view('servicess.create', compact('coins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        //
        $service = new Service();
        $service->name = $request->input('name');
        $service->main_classification = $request->input('main_classification');
        $service->subcategories = $request->input('subcategories');
        $service->service_description = $request->input('service_description');
        $service->cost_amount = $request->input('cost_amount');
        $service->cost_type = $request->input('cost_type');
        $service->coin_id = $request->input('coin');
        $service->notes = $request->input('notes');
        $service->is_active = $request->input('active');

        if ($request->input('main_classification') == 'مباني') {


           
            if ($request->input('subcategories') != '' && $request->input('name_building') != 'null' && $request->input('area') != 'null' && $request->input('rent_value') != 'null') {
                $isSaved = $service->save();
                $ID = $service->id;

                $buliding = new Building();
                $buliding->service_id = $ID;
                $buliding->name_building = $request->input('name_building');
                $buliding->area = $request->input('area');
                $buliding->rent_value = $request->input('rent_value');
                $buliding->name_building = $request->input('name_building');
                $isSaved = $buliding->save();
            }
            else {
                return response()->json([
                    'message'=> 'يجب ادخال البيانات '
                ], Response::HTTP_BAD_REQUEST);
            }

        }else{
            $isSaved = $service->save();


        }


        return response()->json([
            'message' => $isSaved ? 'تم انشاء الخدمة بنجاح !' : 'فشل انشاء خدمة, يرجى المحاولة مرة أخرى.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
        $coins = Coin::where('is_active', true)->get();
        return response()->view('servicess.edit', compact('service', 'coins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        //
        $service->name = $request->input('name');
        $service->main_classification = $request->input('main_classification');
        $service->service_description = $request->input('service_description');
        $service->cost_amount = $request->input('cost_amount');
        $service->cost_type = $request->input('cost_type');
        $service->coin_id = $request->input('coin');
        $service->notes = $request->input('notes');
        $service->is_active = $request->input('active');

        $isSaved = $service->save();
        return response()->json([
            'message' => $isSaved ? 'تم تعديل الخدمة بنجاح !' : 'فشل تعديل  خدمة, يرجى المحاولة مرة أخرى.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        $isDeleted = $service->delete();
        return response()->json([
            'message' => $isDeleted ? 'تم الحذف بنجاح ' : 'فشل حذف خدمة, يرجى المحاولة مرة أخرى.',
            'icon' => $isDeleted ? 'success' : 'error'
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function getServicesByCategory($category)
    {
        if ($category != 'صالة' && $category != 'مولد' && $category != 'مياه' && $category != 'مباني') {
            return abort(404);
        }

        $services = Service::where('main_classification', $category)->get(['id', 'name']);
        return response()->json($services);
    }
}
