@extends('layouts.master')

@section('content')

    <h1>@lang('fo.edit_custodio')</h1>
    <hr/>

    {!! Form::model($custodio, [
        'method' => 'PATCH',
        'url' => ['custodio', $custodio->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('nombre_responsable') ? 'has-error' : ''}}">
                {!! Form::label('', trans('fo.nombre_responsable'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('nombre_responsable', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('nombre_responsable', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('ciudad') ? 'has-error' : ''}}">
                {!! Form::label('ciudad', trans('fo.ciudad'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('ciudad', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('ciudad', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
                {!! Form::label('direccion', trans('fo.direccion'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('area_piso') ? 'has-error' : ''}}">
                {!! Form::label('area_piso', trans('fo.area_piso'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('area_piso', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('area_piso', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('documentoIdentificacion') ? 'has-error' : ''}}">
                {!! Form::label('documentoIdentificacion', trans('fo.documentoIdentificacion'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('documentoIdentificacion', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('documentoIdentificacion', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('cargo') ? 'has-error' : ''}}">
                {!! Form::label('cargo', trans('fo.cargo'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('cargo', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('cargo', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
    <div class="form-group {{ $errors->has('pais') ? 'has-error' : ''}}">
        {!! Form::label('pais', trans('fo.pais'), ['class' => 'control-label']) !!}
        <div class="ekihk">
            {!! Form::text('pais', null, ['class' => 'form-control']) !!}
            {!! $errors->first('pais', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
            <div class="form-group {{ $errors->has('compania') ? 'has-error' : ''}}">
                {!! Form::label('compania', trans('fo.compania'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('compania', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                    {!! $errors->first('compania', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
                {!! Form::label('telefono', trans('fo.telefono'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', trans('fo.email'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('estado') ? 'has-error' : ''}}">
                {!! Form::label('estado', trans('fo.estado'), ['class' => 'control-label']) !!}
                <div class="ekihk">
                    <?php echo Form::select('estado', \App\Custodios::getENUM('estado'), null, ['class' => 'form-control']); ?>
                    {!! $errors->first('estado', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit(trans('form.update'), ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection