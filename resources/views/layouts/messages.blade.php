@if (count($errors) > 0)
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger" align="left">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> {{ $error }}
    </div>
    @endforeach
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" align="left">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Error!</strong> {{Session::get('error')}}
    </div>
@endif
@if (Session::has('success'))
    <div class="alert alert-success" align="left">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <strong>Success!</strong> {{Session::get('success')}}
    </div>
@endif