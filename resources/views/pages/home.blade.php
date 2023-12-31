@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::user()->PWD == "0")
                    {{ __('You are logged in!') }}
                    @else
                        {{ __('You are logged in as pwd!') }}
                    @endif
                </div>
                <a href="/messages"><button class="btn btn-primary">Message</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
