@extends('layouts.app')
@extends('layouts.hotel-topbar')

@section('head')
    <link rel="stylesheet" href="css/app.css">
    <script src="js/app.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('Add Rooms') }}</h4></div>
                <div class="card-body">
                @if(Session::has('msg'))
                <div class="alert alert-success alert-dismissible text-center mb-4" role="alert">
                    <div class="row">
                        <p class="mb-0 ml-3"><strong class="mr-5">{{ Session::get('msg')['status'] }}</strong></p>
                        <p class="mb-0 ml-3">{{ Session::get('msg')['msg'] }}</p> 
                    </div>                                               
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                {{ Session::forget('msg') }}
                    <form class="custom-validation" method="post" action="/new-room" autocomplete="off">
                        @csrf()
                        <div class="row mb-4 mt-2">
                            <div class="col-md-10">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-4 mt-2">Room Number</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('room_number') }}" name="room_number" required/>
                                        <div>
                                            @if ($errors->any())
                                                @foreach ($errors->get('room_number') as $error)
                                                    <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                                @endforeach
                                            @endif
                                        </div> 
                                        <div class="text-danger" style="font-size: 1em;">{{Session::get('room_error')}}</div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-4 mt-2">Floor No</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('floor_number') }}" name="floor_number" required />
                                        <div>
                                            @if ($errors->any())
                                                @foreach ($errors->get('floor_number') as $error)
                                                    <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                                @endforeach
                                            @endif
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 mt-2">No of Bed Available</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{ old('bed_count') }}" required name="bed_count" />
                                        <div>
                                            @if ($errors->any())
                                                @foreach ($errors->get('bed_count') as $error)
                                                    <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light ml-1">
                                            CREATE
                                        </button>
                                    </div>
                                </div>
                            </div>                            
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3 justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h4>{{ __('Available Rooms') }}</h4></div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" 
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Room ID</th>
                            <th>Room Number</th>
                            <th>Floor Number</th>
                            <th>No of Beds</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                        @foreach($room_data as $data)
                        <tr>
                            <td>{{ $data['room_id'] }}</td>
                            <td>{{ $data['room_number'] }}</td>
                            <td>{{ $data['floor'] }}</td>
                            <td>{{ $data['beds'] }}</td>                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    

