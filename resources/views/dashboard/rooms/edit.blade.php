@extends('dashboard.layout.master')

@section('page-title')
    {{ $page_title=ucwords('edit room') }}
@endsection
@section('content')
    @csrf
    {{--Update Status--}}
    @include('dashboard.status.status')
    {{--simple error tracing--}}
    @include('dashboard.simple error tracing.simple_error_tracing')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst(trans($page_title.' '.$room->number)) }}
                <small>Created at{{ date_format($room->created_at, 'jS M Y') }} / Updated
                    at{{ date_format($room->updated_at, 'jS M Y') }}</small>
            </h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('dashboard.rooms.update',$room->id) }}" class="form-group mb-0"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <!-- _token input -->
                <div class="form-group">
                    {{ csrf_field() }}
                </div>
                <!-- Room number input -->
                <div class="form-group">
                    <label for="inputRoomNumber">Room number</label>
                    <input name="number" type="number" class="form-control @error('number') is-invalid @enderror"
                           id="inputRoomNumber"
                           placeholder="Enter room number" value="{{ $room->number }}">
                    @error('number')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Room Type input -->
                <div class="form-group">
                    <label for="inputRoomType">Room Type</label>
                    <select name="type" id="inputRoomType"
                            class="form-control custom-select @error('type') is-invalid @enderror">
                        <option selected="selected" disabled>Select one</option>
                        @foreach($room_types as $room_type)
                            <option value="{{ $room_type->id }}"
                                    @if( $room->room_type_id  === $room_type->id) selected="selected" @endif >{{ $room_type->name }}</option>
                        @endforeach
                    </select>
                    @error('type')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('dashboard.rooms.index') }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create New Room" class="btn btn-success float-right">
            </div>
        </form>
    </div>
@endsection
