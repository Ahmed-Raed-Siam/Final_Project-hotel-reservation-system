@extends('dashboard.layout.master')

@section('page-title')
    {{ $page_title=ucwords('booking table') }}

@endsection
@section('content')
    {{--Update Status--}}
    @include('dashboard.status.status')
    <div class="card p-2">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst($page_title) }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body p-0">
            <table class="table table-hover table-responsive table-striped projects">
                <thead>
                <tr>
                    <th style="width: 1%">#</th>
                    <th style="width: 15%">Room</th>
                    {{--<th style="width: 12%">Reservation for</th>--}}
                    <th style="width: 12%">Booking For</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Reservation?</th>
                    <th>Paid?</th>
                    <th>Started</th>
                    <th>Passed</th>
                    <th>Created</th>
                    <th style="width: 20%">
                        <a class="btn btn-outline-primary m-auto d-flex text-center float-right"
                           href="{{ route('dashboard.bookings.create') }}"
                           data-toggle="tooltip" data-placement="top"
                           title="ADD Booking {{ $counter }}">
                            <i class="fas fa-plus-square p-1"></i>
                            Add Booking
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td>
                            #{{ $counter++ }}
                        </td>
                        <td>
                            <a>
                                {{ $booking->room->number }} {{ $booking->room->roomType->name }}
                            </a>
                            <br/>
                            <small>
                                Created {{ $booking->room->created_at }}
                            </small>
                        </td>
                        <td>
                            <a>
                                {{ $booking->user_model()->name }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ date('F d, Y', strtotime($booking->start)) }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ date('F d, Y', strtotime($booking->end)) }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ $booking->is_reservation ? 'Yes' : 'No' }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ $booking->is_paid ? 'Yes' : 'No' }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ (strtotime($booking->start) < time()) ? 'Yes' : 'No' }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ (strtotime($booking->end) < time()) ? 'Yes' : 'No' }}
                            </a>
                        </td>
                        <td>
                            <a>
                                {{ date('F d, Y', strtotime($booking->created_at)) }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm"
                               {{--href="{{ route('dashboard.bookings.show',$booking->id) }}"--}}
                               {{--OR--}}
                               href="{{ route('dashboard.bookings.show',['booking' => $booking->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               title="View Booking {{ $counter-1 }}">
                                <i class="fas fa-external-link-alt"></i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm"
                               href="{{ route('dashboard.bookings.edit',['booking' => $booking->id]) }}"
                               data-toggle="tooltip" data-placement="top"
                               title="Edit Booking {{ $counter-1 }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form class="btn btn-danger btn-sm m-0"
                                  action="{{ route('dashboard.bookings.destroy', ['booking' => $booking->id]) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                {{ csrf_field() }}
                                <i class="fas fa-trash-alt">
                                </i>
                                <input name="delete" type="submit" class="btn btn-danger btn-sm p-0"
                                       value="Delete"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Delete Booking {{ $counter-1 }}">
                            </form>
                        </td>
                    </tr>
                @empty
                @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer w-100 m-0 pt-sm-2 pr-sm-2 pl-sm-1 bg-light">
            <div class="d-block p-2">
                <ul class="pagination m-auto d-flex justify-content-center float-right ">
                    {!! $bookings->links('vendor.pagination.custom') !!}
                </ul>
            </div>
            <!-- /.card-footer -->

        </div>
@endsection
