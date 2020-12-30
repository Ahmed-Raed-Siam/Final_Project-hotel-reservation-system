<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RoomTypeTrashController extends Controller
{
    /**
     * RoomTypeTrashController constructor.
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
//        $rooms_type = RoomType::onlyTrashed()->paginate(10);
        // OR
        $rooms_type = DB::table('room_types')->whereNotNull('deleted_at')->paginate(10);

        return response()->view('dashboard.room_types.trash.index', ['rooms_type' => $rooms_type]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): ?Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): ?Response
    {
        //
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        // Find Room Type ID
        $room_type = RoomType::onlyTrashed()->findOrFail($id);
        $room_type_id = $id;
        $room_type_name = $room_type->name;
        $room_type_description = $room_type->description;

        // Status for Restoring this Room Type To The System!
        $alert_status = 'alert-success';
        // Msg
        $msg = "Restore Room Type $room_type_name Successfully.";
        // Pref
        $pref = "You Restore $room_type_name Room Type from The Trash in System!<br>Hes ID : {$room_type_id} ,Her Description : $room_type_description . ";
        $status = ['alert_status' => $alert_status, 'msg' => $msg, 'pref' => $pref];

        /*Restore*/
        $room_type->restore();
        // Restore in one line
        //RoomType::withTrashed()->find($id)->restore();

        return redirect()->route('dashboard.rooms.types.trash.index')->with('status', $status);
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
        $room_type = RoomType::onlyTrashed()->findOrFail($id);
        return response()->view('dashboard.room_types.trash.show', ['room_type' => $room_type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): ?Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id): ?Response
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        // Find Room Type ID
        $room_type = RoomType::onlyTrashed()->findOrFail($id);
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

        /* Force Delete (Permanently) To delete from soft-deleted (trashed) data */
        $room_type->forceDelete();


        return redirect()->route('dashboard.rooms.types.trash.index')->with('status', $status);

    }
}
