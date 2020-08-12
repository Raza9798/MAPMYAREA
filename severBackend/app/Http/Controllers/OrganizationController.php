<?php

namespace App\Http\Controllers;

use App\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $_getData = Organization::orderby('id','DESC')->get();

        return response()->json([
            'getData' => $_getData
        ]);
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
        $_attributes = $this->StoreValidation($request); 
        $_storeData = Organization::create($_attributes);
		
		$_getData = Organization::orderby('id','DESC')->get();


        return response()->json([
            'success' => 'Organization Information Successfully Registered',
            'store' => $_storeData,
            'storeData' => $_getData
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        //
    }

    public function StoreValidation(Request $request)
    {
        return $this->validate($request, [
            "Name" => ['bail'],
            "Phone" => ['bail'],
            "Lat" => ['bail'],
            "Lng" => ['bail'],
            "Desc" => ['bail'], 
        ]);
    }
}
