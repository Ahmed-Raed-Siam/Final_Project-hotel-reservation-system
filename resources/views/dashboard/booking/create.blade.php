@extends('dashboard.layout.master')

@section('page-title')
    {{ $page_title=ucwords('create booking for user') }}
@endsection
@section('content')
    @csrf
    {{--Update Status--}}
    @include('dashboard.status.status')
    {{--simple error tracing--}}
    @include('dashboard.simple error tracing.simple_error_tracing')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst($page_title) }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('dashboard.users.roles.store') }}" class="form-group mb-0"
              enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- _token input -->
                <div class="form-group">
                    {{ csrf_field() }}
                </div>
                <!-- Room input -->
                <div class="form-group">
                    <label for="inputRoom">Room</label>
                    <select name="room" id="inputRoom"
                            class="form-control custom-select @error('room') is-invalid @enderror">
                        <option selected="selected" disabled>Select one</option>
                        @foreach($rooms as $id => $display)
                            <option value="{{ $id }}"
                                    @if( isset($booking->room_id) && $id === $booking->room_id) selected="selected" @endif >{{ $display }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">The room number being booked.</small>
                    @error('room')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Username input -->
                <div class="form-group">
                    <label for="inputUsername">Username</label>
                    <select name="username" id="inputUsername"
                            class="form-control custom-select @error('username') is-invalid @enderror">
                        <option selected="selected" disabled>Select one</option>
                        @foreach($users as $id => $display)
                            <option value="{{ $id }}"
                                    @if( isset($bookingsUser->user_id) && $id === $bookingsUser->user_id) selected="selected" @endif >{{ $display }}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">The user booking the room.</small>
                    {{--                    {{ dd($users,$id,$display) }}--}}

                    @error('username')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Booking Start Date input -->
                <div class="form-group">
                    <label for="inputStartDate">Start Date</label>
                    <div class="input-group date" id="start-date" data-target-input="nearest">
                        <input name="start_date" type="text"
                               class="form-control datetimepicker-input @error('start_date') is-invalid @enderror"
                               id="inputStartDate"
                               placeholder="dd/mm/yyyy"
                               value="{{ old('start_date') ?? $booking->start ?? '' }}" required>
                        <div class="input-group-append" data-target="#start-date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <small class="form-text text-muted">The start date for the booking.</small>
                    @error('start_date')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Booking End Date input -->
                <div class="form-group">
                    <label for="inputEndDate">End Date</label>
                    <div class="input-group date" id="end-date" data-target-input="nearest">
                        <input name="end_date" type="text"
                               class="form-control datetimepicker-input @error('end_date') is-invalid @enderror"
                               id="inputEndDate"
                               placeholder="dd/mm/yyyy"
                               value="{{ old('end_date') ?? $booking->end ?? '' }}" required>
                        <div class="input-group-append" data-target="#end-date" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    <small class="form-text text-muted">The start date for the booking.</small>
                    @error('end_date')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{--Select Paid Options For User Checkbox input--}}
                <div class="form-group">
                    <label>Paid Options :</label><br>
                    <div class="row">
                        <div class="col-6">
                            <label class="custom-control "><input type="checkbox" name="is_paid[]"
                                                                  class="form-check-input"
                                                                  value="1"
                                                                  @if( is_array(old('is_paid')) && in_array($booking->is_paid, old('is_paid'), false)) checked @endif
                                >Pre-Paid</label>
                        </div>
                    </div>
                </div>
                <!-- Booking Note input -->
                <div class="form-group">
                    <label for="inputBookingNotes">Notes</label>
                    <input name="booking_notes" type="text" class="form-control @error('booking_notes') is-invalid @enderror"
                           id="inputBookingNotes"
                           placeholder="Enter notes" value="{{ old('booking_notes') }}">
                    <small class="form-text text-muted">Any notes for the booking.</small>
                    @error('booking_notes')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('dashboard.users.roles.index') }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create new Role for user" class="btn btn-success float-right">
            </div>
        </form>
    </div>
@endsection
@section('js-script')
    <script>
        //Date range picker
        $('#start-date').datetimepicker({
            format: 'L'
        });
        $('#end-date').datetimepicker({
            format: 'L'
        });
    </script>
@endsection
