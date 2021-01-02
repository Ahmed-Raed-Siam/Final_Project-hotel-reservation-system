<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $roomType = RoomType::select('*')->get();
        $count = count($roomType);
        return response([
            "status" => "success",
            "count" => $count,
            "data" => $roomType,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Get all inputs from the form
        $inputs = $request->all();
        // Validate inputs
        $request->validate([
            'name' => 'required|string|unique:room_types|max:255',
            'description' => 'required|string|unique:room_types',
            'room_type_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Create instance from Room Type model
        $room_type = new RoomType();
        $room_name = $inputs['name'];
        $room_description = $inputs['description'];
        $room_image = $request->file('room_type_image');
        $room_image_filename = time() . '.' . $room_image->getClientOriginalExtension();
        // Storage the image to
        $room_image->move('images/rooms_type', $room_image_filename);
        // OR if you have storage should create storage to store like :
//        $room_image->store(public_path('images/rooms_type'),$room_image_filename);
        $room_type->name = $room_name;
        $room_type->description = $room_description;
        $room_type->picture = $room_image_filename;

        // Add a Room Type to a the system
        $room_type->save();

        // Get Last ID || Room Type ID
        $room_type_id = RoomType::all()->last();

        return response([
            "status" => "roomType created successfully",
            "data" => $room_type,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param RoomType $roomType
     * @return Response
     */
    public function show(RoomType $roomType): Response
    {
        return response([
            "status" => "success",
            "data" => $roomType,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param RoomType $roomType
     * @return Response
     */
    public function update(Request $request, RoomType $roomType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param RoomType $roomType
     * @return Response
     */
    public function destroy(RoomType $roomType)
    {
        //
    }
}
