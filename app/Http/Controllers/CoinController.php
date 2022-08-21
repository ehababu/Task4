<?php

namespace App\Http\Controllers;
use App\Models\coin;
use App\Http\Requests\StoreCoinRequest;
use App\Http\Requests\UpdateCoinRequest;
use Symfony\Component\HttpFoundation\Response;


class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $coins = Coin::orderBy('created_at', 'DESC')->get();
        return response()->view('coins.index', compact('coins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('coins.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCoinRequest $request)
    {
        //
        $coin = new Coin();
        $coin->name = $request->input('name');
        $coin->is_active = $request->input('active');
        $isSaved = $coin->save();
        return response()->json([
            'message' => $isSaved ? 'تم انشاء بنجاح ' : 'فشل إنشاء عملة، يرجى المحاولة مرة أخرى.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function show(coin $coin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function edit(coin $coin)
    {
        //
        return response()->view('coins.edit', compact('coin'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCoinRequest $request, coin $coin)
    {
        //
        $coin->name = $request->input('name');
        $coin->is_active = $request->input('active');
        $isSaved = $coin->save();
        return response()->json([
            'message' => $isSaved ? 'تم التعديل  بنجاح ' : 'فشل تعديل عملة، يرجى المحاولة مرة أخرى.',
        ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function destroy(coin $coin)
    {
        //
        $isDeleted = $coin->delete();
        return response()->json([
            'message' => $isDeleted ? 'تم الحذف بنجاح ' : 'فشل حذف عملة، يرجى المحاولة مرة أخرى.',
            'icon' => $isDeleted ? 'success' : 'error'
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
