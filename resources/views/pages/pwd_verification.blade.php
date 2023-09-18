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
                    {{ __('PWD Verification') }}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th scope="col">Id</th>
                              <th scope="col">Name</th>
                              <th scope="col">Image</th>
                              <th scope="col">Verify</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($users as $user)
                                <tr>
                                  <td>{{$user->id}}</td>
                                  <td>{{$user->name}}</td>
                                  <td><img src="{{ asset('storage/images/user/' . $user->id . '/' . $user->user_id_verification_image) }}" width="100"></td>
                                  <td>
                                    <form method="POST" action="{{ route('verify-user', ['id' => $user->id]) }}">
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
