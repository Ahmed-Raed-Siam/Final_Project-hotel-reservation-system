<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * RoomController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
//        $rooms = DB::table('rooms')->paginate(10);
        $rooms = Room::paginate(10);
//        $room = $rooms->firstWhere('id',1);
//        $room = Room::findOrFail(1);
//        $roomType_info=$room->roomType()->first()->name;
//        $roomType_info2=$room->roomType->name;
        return response()->view('dashboard.rooms.index', ['rooms' => $rooms]);

//        dd($rooms, $room,$room->roomType->name);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        // Get all room types ;
        $room_types = RoomType::all();
        return response()->view('dashboard.rooms.create', ['room_types' => $room_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Get all inputs from the form
        $inputs = $request->all();
        // Validate inputs
        $request->validate([
            'number' => 'required|string|unique:rooms|max:255',
            'type' => 'required||numeric|exists:room_types,id', // validating Room Type
        ]);
        // Create instance from Room model
        $room = new Room();
        $room_number = (int)$inputs['number'];
        $room_type = (int)$inputs['type'];
        $room->number = $room_number;
//        $room->room_type_id = (int)$room_number;

        // Link Foreign room_type_id to room_types table
        $room->roomType()->associate($room_type);
//        $room->roomType()->sync($room_type);

        // Add a room to a the system
        $room->save();

        // Get Last ID || Room ID
        $room_id = $room::all()->last();

        $room_type_name = $room_id->roomType->name;


        // Status for Adding the New Room To The System!
        $alert_status = 'alert-success';
        // Msg
        $msg = 'New Room Added Successfully.';
        // Pref
        $pref = "You Add Room $room_number As New Room To The System!<br>Her ID : {$room_id['id']} ,Her Type : $room_type_name . ";
        $status = ['alert_status' => $alert_status, 'msg' => $msg, 'pref' => $pref];

        return redirect()->back()->with('status', $status);
//        dd($request->all(),$room_id,$room_id['id'],$room_type_name);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        // Find Room ID
        $room = Room::findOrFail($id);
//        $roomType = $room->roomType_model();
        return response()->view('dashboard.rooms.show', ['room' => $room]);
//        dd($room,$roomType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        // Find Room ID
        $room = Room::findOrFail($id);
        // Get all room types ;
        $room_types = RoomType::all();
        return response()->view('dashboard.rooms.edit', ['room' => $room, 'room_types' => $room_types]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        // Get all inputs from the form
        $inputs = $request->all();
        // Validate inputs
        $request->validate([
            'number' => 'required|string|exists:rooms|max:255',
            'type' => 'required||numeric|exists:room_types,id', // validating Room Type
        ]);
        // Find Room ID
        $room = Room::findOrFail($id);
        $room_id = $id;
        $room_number = (int)$inputs['number'];
        $room_type = (int)$inputs['type'];
        $room->number = $room_number;
        //$room->room_type_id = (int)$room_number;

        // Link Foreign room_type_id to room_types table
        $room->roomType()->associate($room_type);

        // Edit this room data and store them to the system
        $room->save();

        $room_type_name = $room->roomType->name;


        // Status for Editing the Room in The System!
        $alert_status = 'alert-success';
        // Msg
        $msg = "Edit Room $room_number Successfully.";
        // Pref
        $pref = "You Edit Room $room_number in The System!<br>Her ID : {$room_id} ,Her Type : $room_type_name . ";
        $status = ['alert_status' => $alert_status, 'msg' => $msg, 'pref' => $pref];

        return redirect()->route('dashboard.rooms.index')->with('status', $status);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        // Find Room ID
        $room = Room::findOrFail($id);
        $room_id = $id;
        $room_number = $room->number;
        $room_type_name = $room->roomType->name;

        // Status for Deleting This Room from The System!
        $alert_status = 'alert-warning';
        // Msg
        $msg = "Delete Room $room_number Successfully.";
        // Pref
        $pref = "You Delete Room $room_number from The System!<br>Her ID : {$room_id} ,Her Type : $room_type_name . ";
        $status = ['alert_status' => $alert_status, 'msg' => $msg, 'pref' => $pref];

        $room->delete();
        // or
//        $room->destory();

        return redirect()->route('dashboard.rooms.index')->with('status', $status);

    }
}
