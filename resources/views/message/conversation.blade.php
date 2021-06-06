@extends('layouts.app')
@extends('layouts.script')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="row chat-row">
        <div class="users">
            <ul class="list-group list-chat-item">
                @if($users->count())
                    @foreach($users as $user)
                        
                    @endforeach
                @endif
            </ul>
        </div>
    

    <div class="col-md-12 chat-section">
        <div class="chat-header">
            <div class="chat-image">
                {!! makeImageFromName($friendInfo->nom) !!}
            </div>

            <div class="chat-name font-weight-bold">
                {{ $friendInfo->nom }}
               {{-- <i class="fa fa-circle user-status-head user-icon-{{ $user->id }}" title="away"
                   @if($user->id == $friendInfo->id) active @endif
                   id="userStatusHead{{$friendInfo->id}}"></i>--}}
            </div>
        </div>

        <div class="chat-body" id="chatBody">
            <div class="message-listing" id="messageWrapper">
               
  
            </div>
        </div>

        <div class="chat-box">
            <div class="chat-input bg-white" id="chatInput" contenteditable="">

            </div>

            <div class="chat-input-toolbar">
                <button title="Add File" class="btn btn-light btn-sm btn-file-upload">
                    <input type="file" id="hidden" class="file-input hide" name="file-input" id="file-input">
                    <div class="filename-container hide"></div>
                    <i class="fa fa-paperclip"></i>
                </button> |

                <button title="Bold" class="btn btn-light btn-sm tool-items"
                        onclick="document.execCommand('bold', false, '');">
                    <i class="fa fa-bold tool-icon"></i>
                </button>

                <button title="Italic" class="btn btn-light btn-sm tool-items"
                        onclick="document.execCommand('italic', false, '');">
                    <i class="fa fa-italic tool-icon"></i>
                </button>
            </div>
        </div>
    </div>
</div>


<style>
    .filename {
    display: inline-block;
    padding: 0 10px;
    margin-right: 10px;
    background-color: #ccc;
    border: 1px solid black;
    border-radius: 15px;
    height: 20px;
    line-height: 20px;
    text-align: center;
    font-weight: 700;
    font-size: 12px;
    font-family: 'verdana', sans-serif;
    }

    .hide {
    display: none;
    }
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
    .chat-header {
        min-height: 60px;
        padding: 10px;
        margin-bottom: 2px;
        background: #ffffff
    }
    
   .chat-body {
        height: calc(100vh - 375px);
        background: #ffffff;
        padding: 30px 50px;
        margin-bottom:4px;
        position: relative;
    }
    
    .message-text {
        margin-left: 45px;
        margin-top: -10px;
    }
    
    .chat-input {
        border: 1px solid lightgray;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        padding: 8px 10px;
    }
    
    .chat-input-toolbar {
        border-left: 1px solid gray;
        border-right: 1px solid gray;
        border-bottom: 1px solid gray;
        padding: 8px 10px;
    }
    
    .chat-input-toolbar .tool-items {
        margin-right: 5px;
        opacity: 0.3;
    }
</style>

<script>
    /*File button*/
    $(document).ready(function() { 
    $('.file-input').change(function() {
        $file = $(this).val();
        $file = $file.replace(/.*[\/\\]/, ''); //grab only the file name not the path
        $('.filename-container').append("<span  class='filename'>" + $file + "</span>").show();
    })

    });
    /*Online icon*/
    $(function (){
                let $chatInput = $(".chat-input");
                let $chatInputToolbar = $(".chat-input-toolbar");
                let $chatBody = $(".chat-body");
                let $messageWrapper = $("#messageWrapper");
                let user_id = "{{ auth()->user()->id }}";
                let ip_address = '192.168.1.7';
                let socket_port = '8005';
                let socket = io(ip_address + ':' + socket_port);
                let friendId = "{{ $friendInfo->id }}";
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
                $chatInput.keypress(function (e) {
                let message = $(this).html();
                if (e.which === 13 && !e.shiftKey) {
                    $chatInput.html("");
                    sendMessage(message);
                    return false;
                }
                });
                function sendMessage(message) {
                    let url = "{{ route('message.send-message') }}";
                    let form = $(this);
                    let formData = new FormData();
                    let token = "{{ csrf_token() }}";
                    formData.append('message', message);
                    formData.append('_token', token);
                    formData.append('receiver_id', friendId);
                    appendMessageToSender(message);
                    $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                        processData: false,
                        contentType: false,
                        dataType: 'JSON',
                    success: function (response) {
                        if (response.success) {
                            console.log(response.data);
                        }
                    }
                    });
                }
                function appendMessageToSender(message) {
                    let name = '{{ $myInfo->nom }}';
                    let image = '{!! makeImageFromName($myInfo->nom) !!}';
                    let userInfo = '<div class="col-md-12 user-info">\n' +
                        '<div class="chat-image">\n' + image +
                        '</div>\n' +
                        '\n' +
                        '<div class="chat-name font-weight-bold">\n' +
                        name + '<span class="small time text-gray-500" title="'+getCurrentDateTime()+'">\n' +
                        getCurrentTime()+
                        '</span>\n' +
                        '</div>\n' +
                        '</div>\n';
                    let messageContent = '<div class="col-md-12 message-content">\n' +
                        '                            <div class="message-text">\n' + message +
                        '                            </div>\n' +
                        '                        </div>';
                    let newMessage = '<div class="row message align-items-center mb-2">'
                        +userInfo + messageContent +
                        '</div>';
                    $messageWrapper.append(newMessage);
                }
                function appendMessageToReceiver(message) {
                    let name = '{{ $friendInfo->nom }}';
                    let image = '{!! makeImageFromName($friendInfo->nom) !!}';
                    let userInfo = '<div class="col-md-12 user-info">\n' +
                        '<div class="chat-image">\n' + image +
                        '</div>\n' +
                        '\n' +
                        '<div class="chat-name font-weight-bold">\n' +
                        name +'<span class="small time text-gray-500" title="'+dateFormat(message.created_at)+'">\n' +
                        timeFormat(message.created_at)+
                        '</span>\n' +
                        '</div>\n' +
                        '</div>\n';
                    let messageContent = '<div class="col-md-12 message-content">\n' +
                        '                            <div class="message-text">\n' + message.content +
                        '                            </div>\n' +
                        '                        </div>';
                    let newMessage = '<div class="row message align-items-center mb-2">'
                        +userInfo + messageContent +
                        '</div>';
                    $messageWrapper.append(newMessage);
                }
                socket.on("private-channel:App\\Events\\PrivateMessageEvent", function (message)
                {
                appendMessageToReceiver(message);
                });
            });
</script>
@endsection