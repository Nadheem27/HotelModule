@extends('layouts.app')
@extends('layouts.hotel-topbar')

@inject('user', 'App\Http\Controllers\HotelController')

@section('head')
    <link rel="stylesheet" href="css/app.css">
    <script src="js/app.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('Add Rooms Availability') }}</h4></div>
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
                    <form class="custom-validation" method="post" action="/room-availability" autocomplete="off">
                        @csrf()
                        <div class="row mb-4 mt-2">
                            <div class="col-md-10">
                                <div class="form-group row">
                                    <label class="col-sm-4 mt-2">Select Room Number</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="room_number" required>
                                            <option selected disabled value="">Please Select Room Number</option>
                                            @foreach($room_drop as $data)
                                            <option value="{{ $data['room_number'] }}" {{ $data['room_number'] === old('room_number') ? 'selected' : '' }}>{{ $data['room_number'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-4 mt-2">Check In Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="datepicker"
                                            name="check_in" required min="" value="{{ old('check_in') }}" />
                                            <div>
                                                @if ($errors->any())
                                                    @foreach ($errors->get('check_in') as $error)
                                                        <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                                    @endforeach
                                                @endif
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-sm-4 mt-2">Check Out Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="datepicker1"
                                            name="check_out" required min="" value="{{ old('check_out') }}"/>
                                            <div>
                                                @if ($errors->any())
                                                    @foreach ($errors->get('check_out') as $error)
                                                        <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                                    @endforeach
                                                @endif
                                            </div> 
                                            <div class="text-danger" style="font-size: 1em;">{{Session::get('date_error')}}</div>
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
                <div class="card-header"><h4>{{ __('Rooms Availability') }}</h4></div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" 
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Room Number</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                        @foreach($book_data as $data)
                        <tr>
                            <td>{{ $data['booking_id'] }}</td>
                            <td>{{ $data['room_number'] }}</td>
                            <td>{{ date('d-M-Y',strtotime($data['check_in'])) }}</td>
                            <td>{{ date('d-M-Y',strtotime($data['check_out'])) }}</td>
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
    <script>
        $(document).ready( function(){
            var date = "<?php echo date('Y-m-d', strtotime(today()->format('Y-m-d') .' +1 day'))?>";
            $('#datepicker').attr('min',date);
            $('#datepicker1').attr('min',date);
        })
    </script>

