@extends('admin.master')

@section('content')

    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            {!! Form::open(['id'=>'form_data','url'=>aurl('cities/destroy/all'),'method'=>'delete']) !!}
            {!! $dataTable->table([
            'class'=> 'dataTable table table-stripped table-hover table-bordered'
            ],true) !!}
            {!! Form::close() !!}

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    <!-- The Modal -->
    <div id="multipleDelete" class="modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{trans('admin.delete')}}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="empty_record hidden">
                        <div class="alert alert-danger"><h4>{{trans('admin.please_check_some_records')}}
                                <span class="record_count"></span> ? </h4></div>
                    </div>

                    <div class="not_empty_record hidden">
                        <div class="alert alert-danger"><h4>{{trans('admin.ask_delete_item')}}
                                <span class="record_count"></span> ? </h4></div>
                    </div>

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <div class="empty_record hidden">
                        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Close</button>

                    </div>
                    <div class="not_empty_record hidden">
                        <button type="button" class="btn btn-default cancel" data-dismiss="modal">No</button>
                        <button type="submit" name="del_all"  class="btn btn-danger del_all">Delete</button>
                    </div>

                </div>

            </div>
        </div>
    </div>


    @push('js')
        <script>
            delete_all();
        </script>
    {!! $dataTable->scripts() !!}
    @endpush

@endsection