@extends('layouts.app')
@extends('layouts.script')
@section('content')

<style>
    .chat-row {
        margin: 50px;
    }

    .chat-user-list {
        list-style: none;
    }

    .name-image {
        width: 40px;
        height: 40px;
        color: #ffffff;
        border-radius: 50%;
        font-weight: bold;
        padding-top: 5px;
        display: inline-block;
        text-align: center;
    }
    .chat-image, .chat-name {
        display: inline-block;
    }
    .chat-user-list {
        margin-bottom: 2px;
        padding: 5px;
        height: 50px;
    }

    .chat-user-list.active {
        background: #e4e4e4;
    }

    .user-status-icon {
        position: absolute;
        top: 22px;
        left: 28px;
        color: grey;
    }

    .chat-image {
        position: relative;
    }
</style>

<div class="row chat-row">
    <div class="col-md-3">
        <div class="users">
            <h5>Utilisateurs</h5>
                
            <ul class="list-group list-chat-item">
               @if($users->count())
                  @foreach($users as $user)
                     @if ($user->role != 1)
                        <li class="chat-user-list">  
                           <a href="{{ route('message.conversation', $user->id) }}">
                                <div class="chat-image">
                                    {!! makeImageFromName($user->nom) !!}  
                                    <i class="fa fa-circle user-status-icon user-icon-{{ $user->id }}" title="away"></i>
                                </div>

                                <div class="chat-name font-weight-bold">
                                    {{ $user->nom }}
                                </div>
                            </a>
                        </li>
                      @endif
                     @endforeach 
                    
                @endif
            </ul>
        </div>
    </div>
     
    <div class="col-md-9">
        <br>
        <br>
        <br>
        <br>
        <h1>
            Commecer une chat avec nous trokeur.
        </h1>

        <p class="lead">
            Choisir un trokeur commencer une conversiation.
        </p>
    </div>
</div>

<script>
    $(function (){
        let user_id = "{{ auth()->user()->id }}";
        let ip_address = '192.168.1.7';
        let socket_port = '8005';
        let socket = io(ip_address + ':' + socket_port);
        socket.on('connect', function() {
               socket.emit('user_connected', user_id);
            });
        socket.on('updateUserStatus', (data) => {
                let $userStatusIcon = $('.user-status-icon');
                $userStatusIcon.removeClass('text-success');
                $userStatusIcon.attr('title', 'Away');
                $.each(data, function (key, val) {
                   if (val !== null && val !== 0) {
                      let $userIcon = $(".user-icon-"+key);
                      $userIcon.addClass('text-success');
                      $userIcon.attr('title','Online');
                   }
                });
        });    
    });
</script>
@endsection