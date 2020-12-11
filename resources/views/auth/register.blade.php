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
                <div class="card-header">{{ __('New User Registration') }}</div>
                <div class="card-body">
                    <form method="POST"  action="/new-user" autocomplete="off">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="user_name" value="{{ old('user_name') }}"
                                required />
                                <div>
                                    @if ($errors->any())
                                        @foreach ($errors->get('user_name') as $error)
                                            <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="user_email" required 
                                value="{{ old('user_email') }}" />
                                <div>
                                    @if ($errors->any())
                                        @foreach ($errors->get('user_email') as $error)
                                            <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="text-danger email-res" style="font-size: 1em;"></div>
                                <div class="text-danger email-res1" style="font-size: 1em;">{{ Session::get('email_error') }}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-number" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="phone-number" type="text" class="form-control" name="user_phone" required value="{{ old('user_phone') }}" />
                                <div>
                                    @if ($errors->any())
                                        @foreach ($errors->get('user_phone') as $error)
                                            <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="text-danger phone-res" style="font-size: 1em;"></div>
                                <div class="text-danger phone-res1" style="font-size: 1em;">{{ Session::get('phone_error') }}</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="user_address" required
                                value="{{ old('user_address') }}"/>
                                <div>
                                    @if ($errors->any())
                                        @foreach ($errors->get('user_address') as $error)
                                            <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required />
                                <div>
                                    @if ($errors->any())
                                        @foreach ($errors->get('password') as $error)
                                            <div class="text-danger" style="font-size: 1em;">{{ $error }}</div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required />                                
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a class="btn btn-link" href="/login">
                                    {{ __('Already a User? Login here') }}
                                </a>
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
    <script src="{{ URL::asset('js/parsley.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#email").keyup(function() {
                var val = $(this).val();
                $('.email-res').empty();
                $('.email-res1').empty();
                $.ajax({
                    url: "email-check",
                    method: "POST",
                    data: {
                        email: val,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data) {
                            $('.email-res').text(data);
                        }
                    }
                });
            });
            $("#phone-number").keyup(function() {
                var val = $(this).val();
                $('.phone-res').empty();
                $('.phone-res1').empty();
                $.ajax({
                    url: "phone-check",
                    method: "POST",
                    data: {
                        phone: val,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data) {
                            $('.phone-res').text(data);
                        }
                    }
                });
            });
        });
    </script>    
