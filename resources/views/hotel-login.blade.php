@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="css/app.css">
    <script src="js/app.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">{{ __('Hotel - Login') }}</div>
                <div class="card-body">
                    <form method="POST" class="custom-validation" action="/hotel-login-access">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" 
                                name="email" value="{{ old('email') }}" required autocomplete="off"/>
                                <div>
                                    @if ($errors->any())
                                        @foreach ($errors->get('email') as $error)
                                            <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="text-danger error-hotel" style="font-size: 1em;">{{ Session::get('error_hotel') }}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" 
                                name="password" required autocomplete="off"/>
                                <div>
                                    @if ($errors->any())
                                        @foreach ($errors->get('password') as $error)
                                            <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
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

