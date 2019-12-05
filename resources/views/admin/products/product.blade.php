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
            {!! Form::open(['url'=>aurl('products')])!!}

            <a href="#" class="btn btn-primary">Save <i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-success">Save and continue <i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-info">Copy Product <i class="fa fa-file"></i></a>
            <a href="#" class="btn btn-danger">Delete <i class="fa fa-trash-o"></i></a>
            <br>

            <hr>

            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-info-circle"></i> Product Info</a></li>
                <li><a data-toggle="tab" href="#menu0"><i class="fa fa-book"></i> Department</a></li>
                <li><a data-toggle="tab" href="#menu1"><i class="fa fa-gear"></i> Product settings</a></li>
                <li><a data-toggle="tab" href="#menu2"><i class="fa fa-angellist"></i> Product content</a></li>
                <li><a data-toggle="tab" href="#menu3"><i class="fa fa-archive"></i> Weight and size</a></li>
                <li><a data-toggle="tab" href="#menu4"><i class="fa fa-plus"></i> Addition info</a></li>
            </ul>

            <div class="tab-content">

                @include('admin.products.tabs.product_info')
                @include('admin.products.tabs.department')
                @include('admin.products.tabs.product_settings')
                @include('admin.products.tabs.weight_size')
                @include('admin.products.tabs.additional_info')

            </div>

            <a href="#" class="btn btn-primary">Save <i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-success">Save and continue <i class="fa fa-floppy-o"></i></a>
            <a href="#" class="btn btn-info">Copy Product <i class="fa fa-file"></i></a>
            <a href="#" class="btn btn-danger">Delete <i class="fa fa-trash-o"></i></a>
            <br>

            <hr>

                <div class="form-group">
                    {!! Form::label('name_en','Colors name En') !!}
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection