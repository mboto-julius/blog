@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="col-md-4 offset-md-4" style="padding-top: 15%">
            <form action="{{ route('authenticate') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">LOGIN</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @if (Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="password">
                        </div>
                        <div>
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
