@if ($errors->count())
<div class="alert alert-danger" role="alert">
    <strong>Error:</strong> {{  $errors->first() }}
</div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success" role="alert">
        <strong>Success:</strong> {{ Session::get('success') }}
    </div>
@endif