<?php
$message = '';
$class = 'success';

if (Session::get('success')):
    $message = Session::get('success');
    $class = 'success';
elseif (Session::get('error')):
    $message = Session::get('error');
    $class = 'error';
elseif (Session::get('warning')):
    $message = Session::get('warning');
    $class = 'warning';
elseif (Session::get('warning')):
    $message = Session::get('info');
    $class = 'info';
endif;

//Auth::logout();
//Session::flush();
//print_r(session());
?>

@if($message)
<div class="row"> 
    <div class="col-md-12 col-xs-12 col-sm-12">
        <div id="message-div" class="alert alert-{{ $class }}"> 
            {{ $message }}
            <span class="msg-remove">X</span>
        </div>
    </div>
</div>
@endif

<script type="text/javascript">
    $(function () {
        $('#message-div').delay(10000).fadeOut();
        $('.msg-remove').click(function () {
            $('#message-div').hide();
        });
    });
</script>