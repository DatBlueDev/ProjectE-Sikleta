@extends('layouts.app')
@section('content')

<div id = "main" class="text-center" >

    <img src="assets/indexLogo.png" style="width:12rem">
    <div class="card mb-4 box-shadow mt-5" style="width:18rem; margin:auto; ">
        <div class="card-header">
            <h1 class="my-0 font-weight-normal">Welcome!</h1>
        </div>
        <div class="card-body">
            <a href="/login"><button type="button" class="btn btn-light sceneSelectButtons mt-4 mb-4">Log-In</button></a> <hr>
            <a href="/register"><button type="button" class="btn btn-info sceneSelectButtons mt-4 mb-4">Register</button></a> <hr>
        </div>

    </div>

</div>


@endsection
