@extends('layouts.admin')

@section('content')
<div class="col-md-6 col-md-offset-3">
    <h3>Torrent</h3>
    <hr>
    {!! Form::open(['url' => '', 'class' => 'form-horizontal', 'method' => 'post']) !!}
        <div class="form-group">
            {!! Form::label('url', 'From URL', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::url('url', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '']) !!}
            </div>
            <button type="submit" class="btn-sm btn btn-default btn-primary pull-right">Edit</button>
        </div>
    {!! Form::close() !!}

    <!-- Upload Form -->
    {!! Form::open(['url' => route('upload_torrent_file'), 'class' => 'form-horizontal', 'method' => 'post', 'files' => 'true']) !!}
        <div class="form-group">
            {!! Form::label('torrent_file', 'From File', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::file('torrent_file', ['required' => 'required']) !!}
            </div>
            <button type="submit" class="btn-sm btn btn-default btn-primary pull-right">Edit</button>
        </div>
    {!! Form::close() !!}
</div>
@endsection