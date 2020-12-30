@extends('dashboard.layout.master')

@section('page-title')
    {{ $page_title=ucwords('create rooms type') }}
@endsection
@csrf
@section('content')
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
        <form method="POST" action="{{ route('dashboard.rooms.types.store') }}" class="form-group mb-0"
              enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- _token input -->
                <div class="form-group">
                    {{ csrf_field() }}
                </div>
                <!-- Room Type Name input -->
                <div class="form-group">
                    <label for="inputRoomTypeName">Room Type Name</label>
                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                           id="inputRoomTypeName"
                           placeholder="Enter room type name" value="{{ old('name') }}">
                    @error('name')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Room Type Description input -->
                <div class="form-group">
                    <label for="inputRoomTypeDescription">Room Type Description</label>
                    <input name="description" type="text"
                           class="form-control @error('description') is-invalid @enderror"
                           id="inputRoomTypeDescription" placeholder="Enter room type name"
                           value="{{ old('description') }}">
                    @error('description')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Room Type Image input -->
                <div class="form-group">
                    <label for="inputRoomTypeImage">Room Type Image</label>
                    {{--                    <div class="input-group">--}}
                    {{--                        <img alt="No Image" class="table-avatar img-thumbnail" width="30%" height="30%" id="room-type-image-img-tag"--}}
                    {{--                             src="">--}}
                    {{--                    </div>--}}
                    <div class="input-group">
                        <div class="custom-file">
                            <input name="room_type_image" type="file"
                                   class="custom-file-input @error('room_type_image') is-invalid @enderror"
                                   id="inputRoomTypeImage" value="{{ old('room_type_image') }}">
                            <label class="custom-file-label" for="inputRoomTypeImage">Choose Room Type Image
                                file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    @error('room_type_image')
                    <span class="text-sm text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{ route('dashboard.rooms.types.index') }}" class="btn btn-secondary">Cancel</a>
                <input type="submit" value="Create new Rooms Type" class="btn btn-success float-right">
            </div>
        </form>
    </div>
@endsection
@section('js-script')
    <script>

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#room-type-image-img-tag').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        // Execute one time
        $("#inputRoomTypeImage").one('change',function () {
            $('.form-group:last div:first').prepend('<div class="input-group"><img src="" alt="No Image" class="table-avatar img-thumbnail" width="30%" height="30%" style="max-width: 500px;max-height: 330px" id="room-type-image-img-tag"/</div>')
        });
        $("#inputRoomTypeImage").change(function () {
            readURL(this);
        });
    </script>
@endsection
