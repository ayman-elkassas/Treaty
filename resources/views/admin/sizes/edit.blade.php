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
                        'data' :{!! load_dep($size->dept_id) !!},
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

{{--            should determine method because there are many url with--}}
{{--            the same format difer in method --}}
            {!! Form::open(['url'=>aurl('sizes/'.$size->id),'files'=>true,'method'=>'put'])!!}


            <div class="form-group">
                {!! Form::label('name_en','Size name En') !!}
                {!! Form::text('name_en',$size->name_en,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('name_ar','Size name Ar') !!}
                {!! Form::text('name_ar',$size->name_ar,['class'=>'form-control']) !!}
            </div>

            <input type="hidden" name="dept_id" class="dept_id" value="{{$size->dept_id}}">

            <div id="jstree"></div>

            {{--                wornning pure string should in trans() method--}}
            <div class="form-group">
                {!! Form::label('is_public','is_public') !!}
                {!! Form::select('is_public',['yes'=>'yes','no'=>'no'],$size->is_public,['class'=>'form-control']) !!}
            </div>
            {!! Form::submit('Edit',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection

{{--hint--}}
{{--+--------+----------------------------------------+------------------------------+---------------+----------------------------------}}
{{-----------------------------+----------------------+--}}
{{--| Domain | Method                                 | URI                          | Name          | Action--}}
{{--| Middleware           |--}}
{{--+--------+----------------------------------------+------------------------------+---------------+----------------------------------}}
{{-----------------------------+----------------------+--}}
{{--|        | GET|HEAD                               | /                            |               | Closure--}}
{{--| web                  |--}}
{{--|        | GET|HEAD                               | admin                        |               | Closure--}}
{{--| web,Lang,admin:admin |--}}
{{--|        | GET|HEAD                               | admin/admin                  | admin.index   | App\Http\Controllers\Admin\Admi--}}
{{--nController@index          | web,Lang,admin:admin |--}}
{{--|        | POST                                   | admin/admin                  | admin.store   | App\Http\Controllers\Admin\Admi--}}
{{--nController@store          | web,Lang,admin:admin |--}}
{{--|        | GET|HEAD                               | admin/admin/create           | admin.create  | App\Http\Controllers\Admin\Admi--}}
{{--nController@create         | web,Lang,admin:admin |--}}
{{--|        | PUT|PATCH                              | admin/admin/{admin}          | admin.update  | App\Http\Controllers\Admin\Admi--}}
{{--nController@update         | web,Lang,admin:admin |--}}
{{--|        | GET|HEAD                               | admin/admin/{admin}          | admin.show    | App\Http\Controllers\Admin\Admi--}}
{{--nController@show           | web,Lang,admin:admin |--}}
{{--|        | DELETE                                 | admin/admin/{admin}          | admin.destroy | App\Http\Controllers\Admin\Admi--}}
{{--nController@destroy        | web,Lang,admin:admin |--}}
{{--|        | GET|HEAD                               | admin/admin/{admin}/edit     | admin.edit    | App\Http\Controllers\Admin\Admi--}}
{{--nController@edit           | web,Lang,admin:admin |--}}
{{--|        | GET|HEAD                               | admin/forget/password        |               | App\Http\Controllers\Admin\Admi--}}
{{--nAuth@forget_password      | web,Lang             |--}}
{{--|        | POST                                   | admin/forget/password        |               | App\Http\Controllers\Admin\Admi--}}
{{--nAuth@forget_password_post | web,Lang             |--}}
{{--|        | GET|HEAD                               | admin/lang/{lang}            |               | Closure--}}
{{--| web,Lang             |--}}
{{--|        | POST                                   | admin/login                  |               | App\Http\Controllers\Admin\Admi--}}
{{--nAuth@dologin              | web,Lang             |--}}
{{--|        | GET|HEAD                               | admin/login                  |               | App\Http\Controllers\Admin\Admi--}}
{{--nAuth@login                | web,Lang             |--}}
{{--|        | GET|HEAD|POST|PUT|PATCH|DELETE|OPTIONS | admin/logout                 |               | App\Http\Controllers\Admin\Admi--}}
{{--nAuth@logout               | web,Lang,admin:admin |--}}
{{--|        | GET|HEAD                               | admin/reset/password/{token} |               | App\Http\Controllers\Admin\Admi--}}
{{--nAuth@reset_password       | web,Lang             |--}}
{{--|        | POST                                   | admin/reset/password/{token} |               | App\Http\Controllers\Admin\Admi--}}
{{--nAuth@reset_password_post  | web,Lang             |--}}
{{--|        | GET|HEAD                               | api/user                     |               | Closure--}}
{{--| web,Lang,auth:api    |--}}
{{--+--------+----------------------------------------+------------------------------+---------------+----------------------------------}}
{{-----------------------------+----------------------+--}}
