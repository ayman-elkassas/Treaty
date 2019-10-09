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
            {!! Form::open(['url'=>aurl('shippings'),'files'=>true])!!}

                <div class="form-group">
                    {!! Form::label('name_en','Shippings name En') !!}
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name_ar','Shippings name Ar') !!}
                    {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('user_id','User name') !!}
                    {!! Form::select('user_id',\App\User::where('level','company')->pluck('name','id'),old('user_id'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('logo','Shippings Logo') !!}
                    {!! Form::file('logo',old('logo'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection