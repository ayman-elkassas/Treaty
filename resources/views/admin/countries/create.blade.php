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
            {!! Form::open(['url'=>aurl('countries'),'files'=>true])!!}

                <div class="form-group">
                    {!! Form::label('country_name_en','Country En') !!}
                    {!! Form::text('country_name_en',old('country_name_en'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country_name_ar','Country Ar') !!}
                    {!! Form::text('country_name_ar',old('country_name_ar'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('code','Code') !!}
                    {!! Form::text('code',old('code'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('mob','Mob') !!}
                    {!! Form::text('mob',old('mob'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('currency','currency') !!}
                    {!! Form::text('currency',old('currency'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('logo','Logo') !!}
                    {!! Form::file('logo',old('logo'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection