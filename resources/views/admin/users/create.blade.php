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
            {!! Form::open(['url'=>aurl('users')])!!}

                <div class="form-group">
                    {!! Form::label('name',trans('admin.name')) !!}
                    {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email',trans('admin.email')) !!}
                    {!! Form::email('email',old('email'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password',trans('admin.password')) !!}
                    {!! Form::password('password',['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('level',trans('admin.level')) !!}
                    {!! Form::select('level',['user'=>'user','vendor'=>'vendor','company'=>'company'],
                    old('level'),['class'=>'form-control','placeholder'=>'.....']) !!}
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection