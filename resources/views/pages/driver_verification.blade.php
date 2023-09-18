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
                    {{ __('Driver Verification') }}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Name</th>
                              <th scope="col">Id</th>
                              <th scope="col">Verify</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($drivers as $driver)
                                <tr>
                                  <td>{{$driver->id}}</td>
                                  <td>{{$driver->name}}</td>
                                  <td><img src="{{ asset('storage/images/driver/' . $driver->id . '/' . $driver->drivers_license_image) }}" width="100"></td>
                                  <td>
                                    <form method="POST" action="{{ route('verify-driver', ['id' => $driver->id]) }}">
                                      @csrf
                                      <button type="submit" class="btn btn-primary">Verify</button>
                                  </form>
                                  </td>
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
