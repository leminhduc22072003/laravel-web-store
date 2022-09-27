@extends('client.master')
@section('css')
    <style type="text/css">
        .login-form {
            width: 340px;
            margin: 50px auto;
        }
        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
        .form-control, .btn {
            min-height: 38px;
            border-radius: 2px;
        }
        .input-group-addon .fa {
            font-size: 18px;
        }
        .btn {
            font-size: 15px;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    <section class="body-content">
        <div class="container">
            <div class="row">
                <div class="login-form">
                    @if(isset($message))
                        <div class="alert alert-danger" role="alert">
                            {{$message}}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('client.user.post-login') }}" method="post">
                        {{ csrf_field() }}
                        <h2 class="text-center">Đăng nhập</h2>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Username" required="required" name="username">

                                @error('username')
                                <p class="danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Password" required="required" name="password">

                                @error('password')
                                <p class="danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

