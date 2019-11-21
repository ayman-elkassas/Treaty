@extends('admin.master')

@section('content')


{{--    department part of jstree--}}
    @push('js')
        <script type="text/javascript">
            $(function () {
                $('#jstree').jstree({
                    "core" : {
                        "themes" : {
                            "variant" : "large"
                        },
                        'data' :{!! load_dep(old('dept_id')) !!},
                    },
                    "plugins" : [ "wholerow" ]
                });
            });

            $('#jstree')
            // listen for event
                .on('changed.jstree', function (e, data) {

                    var i, j, r = [];
                    var name=[];

                    for(i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).id);
                    }

                    if(r.join(', ')!='') {
                        $('.dept_id').val(r.join(', '));
                    }

                });

            $(function () {
                var toggle=false;
                if(toggle==false)
                {
                    $('.single_delete').on('click',function () {
                        $('#deleteModal').fadeIn();
                    });
                    toggle=true;
                }
                else
                {
                    $('.single_delete').on('click',function () {
                        $('#deleteModal').fadeOut();
                    });
                    toggle=false;
                }

                $('.cancel_delete,.close').on('click',function () {
                    $('#deleteModal').fadeOut();
                });

            });

        </script>

    @endpush

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

{{--            {!! Form::open(['route'=>'admin.store'])!!}--}}
{{--            ORRRRRRRRRRRR--}}
            {!! Form::open(['url'=>aurl('sizes')])!!}

                <div class="form-group">
                    {!! Form::label('name_en','Size name En') !!}
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name_ar','Size name Ar') !!}
                    {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
                </div>

                <input type="hidden" name="dept_id" class="dept_id" value="{{old('dept_id')}}">

                <div id="jstree"></div>

            {{--                wornning pure string should in trans() method--}}
                <div class="form-group">
                    {!! Form::label('is_public','is_public') !!}
                    {!! Form::select('is_public',['yes'=>'yes','no'=>'no'],old('is_public'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection