@extends('admin.master')

@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

{{--            {!! Form::open(['route'=>'admin.store'])!!}--}}
{{--            ORRRRRRRRRRRR--}}
            {!! Form::open(['url'=>aurl('colors')])!!}

                <div class="form-group">
                    {!! Form::label('name_en','Colors name En') !!}
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name_ar','Colors name Ar') !!}
                    {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('color','color') !!}
                    {!! Form::color('color',old('color'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection