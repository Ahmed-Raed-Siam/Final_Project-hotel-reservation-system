@extends('dashboard.layout.master')

@section('page-title')
    {{ $page_title=ucwords('rooms type table') }}

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
                    <th style="width: 1%">
                        #
                    </th>
                    <th style="width: 20%">
                        Room name
                    </th>
                    <th style="width: 30%">
                        Description
                    </th>
                    <th>
                        Picture
                    </th>
                    <th style="width: 20%">
                        <a class="btn btn-outline-primary m-auto d-flex text-center float-right"
                           href="{{ route('dashboard.rooms.types.create') }}"
                           data-toggle="tooltip" data-placement="top"
                           title="ADD Room Type {{ $counter }}">
                            <i class="fas fa-plus-square p-1"></i>
                            Add Room Type
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse ($rooms_type as $room_type)
                    <tr>
                        <td>
                            #{{ $counter++ }}
                        </td>
                        <td>
                            <a>
                                {{ $room_type->name }}
                            </a>
                            <br/>
                            <small>
                                Created {{ $room_type->created_at }}
                            </small>
                        </td>
                        <td>
                            <a>
                                {{ $room_type->description }}
                            </a>
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img alt="No Image" class="table-avatar" src="{{ asset('images/rooms_type/'.$room_type->picture) }}">
                                </li>
                            </ul>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm"
                               href="{{ route('dashboard.rooms.types.show',$room_type->id) }}"
                               data-toggle="tooltip" data-placement="top"
                               title="View Room Type {{ $counter-1 }}">
                                <i class="fas fa-external-link-alt"></i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm"
                               href="{{ route('dashboard.rooms.types.edit',$room_type->id) }}"
                               data-toggle="tooltip" data-placement="top"
                               title="Edit Room Type {{ $counter-1 }}">
                                <i class="fas fa-pencil-alt"></i>
                                Edit
                            </a>
                            <form class="btn btn-danger btn-sm m-0"
                                  action="{{ route('dashboard.rooms.types.destroy', ['type' => $room_type->id]) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')
                                {{ csrf_field() }}
                                <i class="fas fa-trash-alt">
                                </i>
                                <input name="delete" type="submit" class="btn btn-danger btn-sm p-0"
                                       value="Delete"
                                       data-toggle="tooltip" data-placement="top"
                                       title="Delete Room Type {{ $counter-1 }}">
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
                    {!! $rooms_type->links('vendor.pagination.custom') !!}
                </ul>
            </div>
            <!-- /.card-footer -->

        </div>
@endsection
