@extends('dashboard.layout.master')

@section('page-title')
    {{ $page_title=ucwords('view rooms') }}
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ ucfirst(trans(substr($page_title,0,-5).' '.$room->id.' '.substr($page_title,strlen($page_title)-5,strlen($page_title)))) }}</h3>

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
                <dt class="col-sm-3">Room ID</dt>
                <dd class="col-sm-9">{{ $room->id }}</dd>

                <dt class="col-sm-3">Room number</dt>
                <dd class="col-sm-9">{{ $room->number }}</dd>

                <dt class="col-sm-3">Room Type</dt>
                <dd class="col-sm-9">{{ $room->roomType->name }}</dd>

                <dt class="col-sm-3">Room description</dt>
                <dd class="col-sm-9">{{ $room->roomType->description }}</dd>

                <dt class="col-sm-3">Created at</dt>
                <dd class="col-sm-9">{{ date('F d, Y', strtotime($room->created_at)) }}</dd>

                <dt class="col-sm-3">Updated at</dt>
                <dd class="col-sm-9">{{ date('F d, Y', strtotime($room->updated_at)) }}</dd>
            </dl>
        </div>
    </div>
@endsection
