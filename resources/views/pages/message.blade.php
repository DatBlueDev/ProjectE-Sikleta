        @extends('layouts.app')

        @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="app" >
                    <div class="card border-info mb-3" style="max-width: 58rem;">
                        <div class="card-header"><h1>Chat</h1>
                            <input class="form-control" type="text" name="username1" id="username1" placeholder="Please enter a username..." value="{{Auth::user()->name}}" disabled>
                            To: <input class="form-control" type="text" name="username2" id="username2" placeholder="Please enter a username..." value="Dababy" disabled>
                        </div>
                        <div class="card-body">
                            <div id="messages"></div>    
                        </div>
                        <div class="card-footer">
                            <form id="message_form">
                                <input class="form-control" type="text" name="message" id="message_input" placeholder="Write a message..." style="width: 93%; display:inline">
                                <button type="submit" class="btn btn-primary" id="message_send" style="display: inline">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
