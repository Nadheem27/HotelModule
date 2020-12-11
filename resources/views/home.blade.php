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
                <div class="card-header"><h4>{{ __('Book Room') }}</h4></div>
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
                    <form class="custom-validation" method="post" action="/book-room" autocomplete="off">
                        @csrf()
                        <div class="row mb-4 mt-2">
                            <div class="col-md-10">
                                <div class="form-group row mb-4">
                                    <label class="col-sm-4 mt-2">Select Date</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" id="datepicker"
                                            name="avail_date" required min=""/> 
                                            <div class="text-danger" style="font-size: 1em;">{{Session::get('date_error')}}</div>
                                    </div>
                                </div>                                
                                <div class="form-group row">
                                    <label class="col-sm-4 mt-2">Select Room Number</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="room_number" required>
                                            <option selected disabled value="">Please Select Room Number</option>
                                        </select>
                                        <div class="room-error text-danger" style="font-size: 1em;"></div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light ml-1">
                                            BOOK ROOM
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
        });  
        $(document).ready( function(){      
            $('#datepicker').change(function() {
                var date = $(this).val();
                $('select[name="room_number"]').empty();
                $(".room-error").empty();
                $.ajax({
                    url: "get-room",
                    method: "POST",
                    cache: false,
                    data: { date: date, _token: '{{ csrf_token() }}' },
                    success: function(data) {
                        if (data.status == 'success') {
                            $.each(data.data, function(key, value) {
                                $('select[name="room_number"]').append(
                                    '<option value="' + value + '">' + value +
                                    '</option>');
                            });
                        }else {
                            $(".room-error").text(data.data);
                        }
                    }
                });
            });
        });
    </script>

