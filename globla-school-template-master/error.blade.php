@if ($errors->any())
<div class="combined-error-msg">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>        
        @endforeach
    </ul>
</div>
@endif