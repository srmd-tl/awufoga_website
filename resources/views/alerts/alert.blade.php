@if ($errors->any())
<div class="alert alert-danger" role="alert">
     @foreach ($errors->all() as $error)
    <strong>{{ $error }}</strong>
    @endforeach
</div>
@endif
@if(session('success'))
<div class="alert alert-success" role="alert">
    <strong>{{session('success')}}</strong>
</div>
@endif