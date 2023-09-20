@extends('layouts.admin_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Welcome Admin') }}
                    <ul class="list-group">
                        <a href="/verify_pwd"><li class="list-group-item">PWD Verification</li></a>
                        <a href="/verify_driver"><li class="list-group-item">Driver Verification </li></a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
