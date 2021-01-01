@extends('dashboard.layout.master')

@section('page-title')
    {{ $page_title=ucwords('view booking information') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst(trans(substr($page_title,0,13).' '.$booking->id.' '.substr($page_title,strlen($page_title)-12,strlen($page_title)))) }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <dl class="card-body row">
                <dt class="col-sm-3">Booking ID</dt>
                <dd class="col-sm-9">{{ $booking->id }}</dd>

                <dt class="col-sm-3">Room</dt>
                <dd class="col-sm-9">{{ $booking->room->number }} {{ $booking->room->roomType->name }}</dd>

                <dt class="col-sm-3">Room Type Picture</dt>
                <dd class="col-sm-9">
                    <img class="img-thumbnail"
                         src="{{ asset('images/rooms_type/'.$booking->room->roomType->picture) }}"
                         alt="No Image">
                </dd>

                <dt class="col-sm-3">Booking For</dt>
                <dd class="col-sm-9">{{ $booking->user_model()->name }}</dd>

                <dt class="col-sm-3">Notes</dt>
                <dd class="col-sm-9">{{ $booking->notes }}</dd>

                <dt class="col-sm-3">Start Date</dt>
                <dd class="col-sm-9">{{ date('F d, Y', strtotime($booking->start)) }}</dd>

                <dt class="col-sm-3">End Date</dt>
                <dd class="col-sm-9">{{ date('F d, Y', strtotime($booking->end)) }}</dd>

                <dt class="col-sm-3">Reservation</dt>
                <dd class="col-sm-9">{{ $booking->is_reservation ? 'Yes' : 'No' }}</dd>

                <dt class="col-sm-3">Paid</dt>
                <dd class="col-sm-9">{{ $booking->is_paid ? 'Yes' : 'No' }}</dd>

                <dt class="col-sm-3">Started</dt>
                <dd class="col-sm-9">{{ (strtotime($booking->start) < time()) ? 'Yes' : 'No' }}</dd>

                <dt class="col-sm-3">Passed</dt>
                <dd class="col-sm-9">{{ (strtotime($booking->end) < time()) ? 'Yes' : 'No' }}</dd>

                <dt class="col-sm-3">Created at</dt>
                <dd class="col-sm-9">{{ date('F d, Y', strtotime($booking->created_at)) }}</dd>

                <dt class="col-sm-3">Updated at</dt>
                <dd class="col-sm-9">{{ date('F d, Y', strtotime($booking->updated_at)) }}</dd>
            </dl>
        </div>
    </div>
@endsection
