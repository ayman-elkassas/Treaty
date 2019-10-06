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

{{--            should determine method because there are many url with--}}
{{--            the same format difer in method --}}
            {!! Form::open(['url'=>aurl('trademarks/'.$trademark->id),'files'=>true,'method'=>'put'])!!}

                <div class="form-group">
                    {!! Form::label('name_en','Trademark En') !!}
                    {!! Form::text('name_en',$trademark->name_en,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name_ar','Trademark Ar') !!}
                    {!! Form::text('name_ar',$trademark->name_ar,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('logo','Trademark Logo') !!}
                    {!! Form::file('logo',['class'=>'form-control']) !!}
                </div>

                @if(!empty($trademark->logo))
                    <img src="{{Storage::url($trademark->logo)}}" style="width: 5%;height: 5%;"/>
                @endif

                <br>
                <br>
                <br>

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
