<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoomTypeController extends Controller
{
    /**
     * RoomTypeController constructor.
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
        // Get All Room Types
//        $rooms_type = DB::table('room_types')->whereNull('deleted_at')->paginate(10);
        // OR
        $rooms_type = RoomType::withoutTrashed()->paginate(10);
//        dd($room_types);
        return response()->view('dashboard.room_types.index', ['rooms_type' => $rooms_type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('dashboard.room_types.create');
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

        // Status for Adding the New Room To The System!
        $alert_status = 'alert-success';
        // Msg
        $msg = 'New Rooms Type Added Successfully.';
        // Pref
        $pref = "You Add $room_name As New Room Type To The System!<br>Her ID : {$room_type_id['id']} ,Her Description : $room_description . ";
        $status = ['alert_status' => $alert_status, 'msg' => $msg, 'pref' => $pref];

        return redirect()->back()->with('status', $status);
//        dd($inputs, $room_image,$room_image_filename);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        // Find Room Type ID
        $room_type = RoomType::withoutTrashed()->findOrFail($id);
        return response()->view('dashboard.room_types.show', ['room_type' => $room_type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response
    {
        // Find Room Type ID
        $room_type = RoomType::withoutTrashed()->findOrFail($id);
        return response()->view('dashboard.room_types.edit', ['room_type' => $room_type]);
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'room_type_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Find Room Type ID
        $room_type = RoomType::withoutTrashed()->findOrFail($id);
        $room_type_id = $id;
        $room_type_name = $inputs['name'];
        $room_type_description = $inputs['description'];
        $room_type_image = $request->file('room_type_image');
        $room_image_filename = time() . '.' . $room_type_image->getClientOriginalExtension();

        // Storage the image to
        $room_type_image->move('images/rooms_type', $room_image_filename);
        $room_type->name = $room_type_name;
        $room_type->description = $room_type_description;
        $room_type->picture = $room_image_filename;

        // Update this Room Type to the system
        $room_type->save();

        // Status for Updating this Room Type To The System!
        $alert_status = 'alert-success';
        // Msg
        $msg = 'New Rooms Type Updated Successfully.';
        // Pref
        $pref = "You Update $room_type_name As New Room Type To The System!<br>Her ID : {$room_type_id} ,Her Description : $room_type_description . ";
        $status = ['alert_status' => $alert_status, 'msg' => $msg, 'pref' => $pref];

        return redirect()->route('dashboard.rooms.types.index')->with('status', $status);

    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(int $id): RedirectResponse
    {
        // Find Room Type ID
        $room_type = RoomType::withoutTrashed()->findOrFail($id);
        $room_type_id = $id;
        $room_type_name = $room_type->name;
        $room_type_description = $room_type->description;

        // Status for Deleting This Room from The System!
        $alert_status = 'alert-warning';
        // Msg
        $msg = "Delete Room Type $room_type_name Successfully.";
        // Pref
        $pref = "You Delete $room_type_name Room Type from The System!<br>Her ID : {$room_type_id} ,Her Description : $room_type_description . ";
        $status = ['alert_status' => $alert_status, 'msg' => $msg, 'pref' => $pref];

        // Delete this room type and move it to trash
        $room_type->delete();
        // or
//        $room->destory();

        return redirect()->route('dashboard.rooms.types.index')->with('status', $status);

    }
}
