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
            {!! Form::open(['url'=>aurl('cities')])!!}

                <div class="form-group">
                    {!! Form::label('city_name_en','City En') !!}
                    {!! Form::text('city_name_en',old('city_name_en'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('city_name_ar','City Ar') !!}
                    {!! Form::text('city_name_ar',old('city_name_ar'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('currency','currency') !!}
                    {!! Form::text('currency',old('currency'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country_id','Country Name') !!}
                    {!! Form::select('country_id',App\model\Country::pluck('country_name_en','id')
                    ,old('country_id'),['class'=>'form-control','placeholder'=>'.....']) !!}
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection