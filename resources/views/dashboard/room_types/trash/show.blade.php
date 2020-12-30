@extends('dashboard.layout.master')

@section('page-title')
    {{ $page_title=ucwords('view rooms type') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst(trans($page_title.' '.$room_type->id)) }}</h3>

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
                <dt class="col-sm-3">Room Type Picture</dt>
                <dd class="col-sm-9">
                    <img class="img-thumbnail" src="{{ asset('images/rooms_type/'.$room_type->picture) }}"
                         alt="No Image">
                </dd>

                <dt class="col-sm-3">Room Type ID</dt>
                <dd class="col-sm-9">{{ $room_type->id }}</dd>

                <dt class="col-sm-3">Room Type Name</dt>
                <dd class="col-sm-9">{{ $room_type->name }}</dd>

                <dt class="col-sm-3">Room Type Description</dt>
                <dd class="col-sm-9">{{ $room_type->description }}</dd>

                <dt class="col-sm-3">Created at</dt>
                <dd class="col-sm-9">{{ date('F d, Y', strtotime($room_type->created_at)) }}</dd>

                <dt class="col-sm-3">Updated at</dt>
                <dd class="col-sm-9">{{ date('F d, Y', strtotime($room_type->updated_at)) }}</dd>
            </dl>
        </div>
    </div>
@endsection
