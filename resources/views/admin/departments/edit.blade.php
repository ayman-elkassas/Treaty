@extends('admin.master')

@section('content')

    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

{{--            {!! Form::open(['route'=>'admin.store'])!!}--}}
{{--            ORRRRRRRRRRRR--}}
            {!! Form::open(['url'=>aurl('departments/'.$dep->id),'method'=>'put','files'=>true])!!}

                <div class="form-group">
                    {!! Form::label('dep_name_en','Dep En') !!}
                    {!! Form::text('dep_name_en',$dep->dep_name_en,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('dep_name_ar','Dep Ar') !!}
                    {!! Form::text('dep_name_ar',$dep->dep_name_ar,['class'=>'form-control']) !!}
                </div>

                <div class="clearfix"></div>
                    <div id="jstree"></div>
                    <input type="hidden" name="parent_id" class="parent_id" value="{{$dep->parent_id}}"/>
                <div class="clearfix"></div>

                <div class="form-group">
                    {!! Form::label('description','Dep Desc') !!}
                    {!! Form::textarea('description',$dep->description,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('keyword','Keyword') !!}
                    {!! Form::textarea('keyword',$dep->keyword,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('icon','Icon') !!}
                    {!! Form::file('icon',['class'=>'form-control']) !!}

                    @if(!empty($dep->icon) and Storage::has($dep->icon))
                        <img src="{{Storage::url($dep->icon)}}" style="width: 100px;height: 100px;">
                    @endif

                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

    @push('js')
        <script type="text/javascript">
            $(function () {
                $('#jstree').jstree({
                    "core" : {
                        "data":
                            {!! load_dep($dep->parent_id,$dep->id) !!}
                        ,
                        "themes" : {
                            "variant" : "large"
                        },

                    },
                    "checkbox" : {
                        "keep_selected_style" : false
                    },
                    "plugins" : [ "wholerow"]
                });
            });

            $('#jstree')
            // listen for event
                .on('changed.jstree', function (e, data) {
                    var i, j, r = [];
                    for(i = 0, j = data.selected.length; i < j; i++) {
                        r.push(data.instance.get_node(data.selected[i]).id);
                    }
                    $('.parent_id').val(r.join(', '));
                })
                // create the instance
                // .jstree();

        </script>

    @endpush

@endsection