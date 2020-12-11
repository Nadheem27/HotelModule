@extends('layouts.app')
@extends('layouts.topbar')

@section('head')
    <link rel="stylesheet" href="css/app.css">
    <script src="js/app.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">            
                <div class="card-header"><h4>{{ __('Rooms Booked - Details') }}</h4></div>
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" 
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Room Number</th>
                            <th>Booking Date</th>
                            <th>Booked On</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                        @foreach($booked_rooms as $data)
                        <tr>
                            <td>{{ $data['booking_id'] }}</td>
                            <td>{{ $data['room_number'] }}</td>
                            <td>{{ date('d-M-Y',strtotime($data['avail_date'])) }}</td>
                            <td>{{ date('d-M-Y H:i',strtotime($data['booked_time'])) }}</td>
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
        })
    </script>

