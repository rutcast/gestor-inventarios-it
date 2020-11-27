@extends('layouts.submaster')

@section('sub_text')
    Checklist
@endsection

@section('sub_content')

    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>ID.</th> <th>Area Id</th><th>User Id</th><th>Id Check Lists</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $checklist->id }}</td> <td> {{ $checklist->area_id }} </td><td> {{ $checklist->user_id }} </td><td> {{ $checklist->id_check_lists }} </td>
        </tr>
        </tbody>
    </table>
        <div class="table">

            <table class="table table-bordered table-striped table-hover">

                <thead>

                <tr>

                    <th>@lang('form.sno')</th><th>Atributo</th><th colspan="3">Valores</th>

                </tr>

                </thead>

                <tbody>

                @php $x=0; @endphp

                @foreach($checklist_opcionescheck as $item)

                    @php $x++;@endphp



                    <tr class="actu0jkw34" data-id="{{$item->id}}">

                        <td>{{ $x }}</td>

                        <td>{{ $item->atributo }} </td>

                        <td>{{$item->valor1}}   </td><td>{{$item->valor2}} </td><td>{{$item->valor3}}</td>



                    </tr>

                @endforeach

                </tbody>

            </table>

            <div class="pagination"> {!! $checklist_opcionescheck->render() !!} </div>

        </div>

        <!--  fin   -->

        {!!Form::open(array('action' => array('CheckListController@crearChecklist', $checklist->area_id,$checklist->id))) !!}
        {!! Form::submit('¡Borrar y crear!', ['class' => 'btn btn-danger btn-xs']) !!}
        {!! Form::close() !!}


        {!!Form::open(array('action' => array('CheckListController@editarChecklist', $checklist->area_id,$checklist->id))) !!}
        {!! Form::submit('Editar datos', ['class' => 'btn btn-success btn-xs']) !!}
        {!! Form::close() !!}

@endsection