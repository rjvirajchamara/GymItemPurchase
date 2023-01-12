<?php

namespace App\Http\Controllers;

use App\Models\OderItem;
use App\Models\OrderManagement;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ViweOderDetails(Request $request){

    $viwe_oder=OderItem::with('itemdetails.productdetails')->get();

    $emptyArray = array();

    if ($viwe_oder) {
        return response()->json(["ViweOderDetails"=>$viwe_oder]);
    } else if (!$viwe_oder) {
        return response()->json($emptyArray);
    }


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
     * @param  \App\Models\OrderManagement  $orderManagement
     * @return \Illuminate\Http\Response
     */
    public function show(OrderManagement $orderManagement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderManagement  $orderManagement
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderManagement $orderManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderManagement  $orderManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderManagement $orderManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderManagement  $orderManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderManagement $orderManagement)
    {
        //
    }
}
