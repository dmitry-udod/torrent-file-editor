@extends('layouts.admin')

@section('content')
    <div class="col-md-6 col-md-offset-3">
        <h4>Torrent</h4>
        <hr>
        {!! Form::open(['url' => route('download_torrent_file', $fileName), 'class' => 'form-horizontal', 'method' => 'post']) !!}
            <div class="form-group">
                {!! Form::label('file_name', 'File name', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('file_name', $fileName, ['class' => 'form-control', 'required' => 'required', 'placeholder' => '']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('', 'Hash', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::label('', $torrent->getHash(), ['class' => 'control-label']) !!}
                </div>
            </div>

            <br>

            <h4>Tracker</h4>
            <hr>

            <div class="form-group">
                {!! Form::label('announces', 'URL', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9" id="announces">
                    @foreach($torrent->getAnnounceList() as $key => $announce)
                    <div id="announce{{ $key }}">
                    <span data-remove-id="announce{{ $key }}" class="remove pull-right glyphicon glyphicon-remove" style="position: relative;top: 25px; left: 25px; cursor: pointer"></span>
                    {!! Form::text('announces[]', $announce[0], ['class' => 'form-control']) !!}
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group">
                <a href="#" id="addAnnounce" class="btn-sm btn-primary pull-right" style="margin-right: 50px;">Add URL</a>
            </div>

            <h4>Meta Data</h4>
            <hr>

            <div class="form-group">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('name', $torrent->getName(), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('created_at', 'Created At', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('created_at', Carbon\Carbon::createFromTimestamp($torrent->getCreatedAt()), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('created_by', 'Created By', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('created_by', $torrent->getCreatedBy(), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('comment', 'Comment', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::textarea('comment', $torrent->getComment(), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('comment', 'Piece Length', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-9">
                    {!! Form::text('comment', App\Converter::formatSizeUnits($decodedFile['info']['piece length']), ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                </div>
            </div>

            <br>
            <h4>Files</h4>
            <hr>
            <div class="form-group">
                @if (is_array($torrent->getFileList() ))
                    @foreach($torrent->getFileList() as $file)
                        <div class="col-sm-8">
                            {!! Form::text('files[path][]', $file['path'][0], ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::text('', App\Converter::formatSizeUnits($file['length']), ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                            {!! Form::hidden('files[length][]', $file['length'], ['class' => 'form-control']) !!}
                        </div>
                    @endforeach
                @else
                    <?php $info = $torrent->getInfo(); ?>
                    <div class="col-sm-8">
                        {!! Form::text('files[path][]', $info['name'], ['class' => 'form-control']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::text('', App\Converter::formatSizeUnits($info['length']), ['class' => 'form-control', 'disabled'=>'disabled']) !!}
                        {!! Form::hidden('files[length][]', $info['length'], ['class' => 'form-control']) !!}
                    </div>
                @endif
            </div>

            <br>
            <h4>Finish</h4>
            <hr>
            <div class="col-lg-offset-3">
                <input type="submit" value="Download" class="btn btn-primary center-block pull-left">
                <span class="pull-left center-block" style="margin-top:6px">&nbsp; - Download a new copy of the torrent.</span>
            </div>
        {!! Form::close() !!}
    </div>
@endsection