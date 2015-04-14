@extends('layouts.admin')

@section('content')
<div class="col-md-6 col-md-offset-3">
    <h3>Site map generator</h3>
    <hr>
    {!! Form::open(['url' => route('generate'), 'class' => 'form-horizontal', 'method' => 'post']) !!}
        <div class="form-group">
            {!! Form::label('url', 'Site URL', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-9">
                {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'http://uawebchallenge.com']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('url', 'Deeps level', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('deeps_level', Config::get('settings.deeps_level'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('url', 'Priority for first level pages', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('first_level_priority', 1, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('url', 'Priority for second level pages', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('second_level_priority', 0.8, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('url', 'Priority for other level pages', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-3">
                {!! Form::text('other_level_priority', 0.5, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default btn-primary">Generate</button>
            </div>
        </div>
    {!! Form::close() !!}

    @if (!empty($files))
        <h3>
            Already generated files
        </h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Filename</th>
                <th>Size</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file->getFileName() }}</td>
                    <td>{{ $file->getSize() }}</td>
                    <td>
                        <a target="_blank" href="{{ \App\Generators\SiteMapGenerator::SITE_MAPS_DIRECTORY }}/{{ $file->getFileName() }}">Download</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table
    @endif
</div>
@endsection