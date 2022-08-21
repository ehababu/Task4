<?php

namespace App\Http\Controllers;

use App\Models\BankUp;
use Illuminate\Http\Request;
use App\Models\RentService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreBankUpRequest;




class BankUpController extends Controller
{
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
    public function store(StoreBankUpRequest $request)
    {
        //
        $rentService = RentService::findOrFail($request->input('rentservice'));
        if($rentService->cost_price < ($rentService->total_paid + $request->input('amount_collected'))) {
            return response()->json([
                'message' => 'المبلغ المحصل اكثر من المطلوب',
            ], Response::HTTP_BAD_REQUEST);
        }
        $bankUp = new BankUp();
        $ser_id=$request->input('rentservice');
        $bankUp->receipt_num = $request->input('receipt_num');
        $bankUp->amount_collected = $request->input('amount_collected');
        $bankUp->rentservice_id = $ser_id;
        if($rentService->cost_price == ($rentService->total_paid + $request->input('amount_collected'))) {
            $rentService->status = 'مدفوع';
            $rentService->save();
        }
        $isSaved = $bankUp->save();

        return response()->json([
            'message' => $isSaved ? 'تمت العملية بنجاح ' : 'فشلت العملية ',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankUp  $bankUp
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        $rentService = RentService::findOrFail($id);
        if($rentService->total_paid >= $rentService->cost_price) {
            return redirect()->route('rentService.index');
        }
        return response()->view('bankup.show',compact('rentService'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankUp  $bankUp
     * @return \Illuminate\Http\Response
     */
    public function edit(BankUp $bankUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BankUp  $bankUp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankUp $bankUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankUp  $bankUp
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankUp $bankUp)
    {
        //
    }
}