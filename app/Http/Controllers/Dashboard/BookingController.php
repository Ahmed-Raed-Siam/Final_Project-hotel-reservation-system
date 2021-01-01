<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingUser;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * BookingController constructor.
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
        // Get All Bookings
//        $bookings = Booking::withoutTrashed()->paginate(10);
        //OR
//        $bookings = DB::table('bookings')->whereNotNull('deleted_at')->paginate(10);
        $bookings = Booking::withoutTrashed()->whereHas('users')->paginate(10);
        //OR
//        $bookings = Booking::with(['room.roomType', 'users:name'])->paginate(10);

        // Test to make sure right
        /*        $booking = Booking::withoutTrashed()->findOrFail(1);
                $bookings_info = $booking->room()->first();
        //        $bookings_room_info = $bookings_info->roomType()->first();
                // OR
                $bookings_room_info = $bookings_info->roomType;*/


        return response()->view('dashboard.booking.index', ['bookings' => $bookings]);
//        dd($bookings);
//        dd($bookings, $booking, $booking->users, $bookings_info, $bookings_room_info);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        // Get all available rooms
//        $users = DB::table('users')->get()->pluck('name', 'id')->prepend('none');// with add none value
        $users = DB::table('users')->get()->pluck('name', 'id');// without add none value
        // Get all users
        $rooms = DB::table('rooms')->get()->pluck('number', 'id');
//        $rooms = Room::all()->pluck('name', 'id')->prepend('none');
//        $users = User::all()->pluck('number', 'id');

//        dd($rooms, $users);

        return response()->view('dashboard.booking.create', ['users' => $users, 'booking' => (new Booking()), 'rooms' => $rooms]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        // Get all inputs from the form
        $input = $request->all();
        // Validate inputs
        $request->validate([
            'room' => 'required',
            'username' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'booking_notes' => 'required',
            'is_paid' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        // Find Booking ID
        $booking = Booking::withoutTrashed()->whereHas('users')->findOrFail($id);

        return response()->view('dashboard.booking.show', ['booking' => $booking]);
//        dd($bookings);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
