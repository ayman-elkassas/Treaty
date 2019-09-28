@extends('admin.master')

@section('content')

    @push('js')
        <script type="text/javascript">
            $(function () {

                //if country_id has old value in wrong input
                @if($state->country_id)
                $.ajax({
                    url:'{{aurl('states/create')}}',
                    type:'get',
                    datatype:'html',
                    data:{country_id:'{{$state->country_id}}',select:'{{$state->city_id}}'},
                    success:function (data) {
                        $('.city').html(data);
                    }
                });
                @endif

                $(document).on('change','.country_id',function () {
                    var country=$('.country_id option:selected').val();
                    if(country>0)
                    {
                        $.ajax({
                            url:'{{aurl('states/create')}}',
                            type:'get',
                            datatype:'html',
                            data:{country_id:country,select:''},
                            success:function (data) {
                                $('.city').html(data);
                            }
                        });
                    }
                    else
                    {
                        $('.city').html('');
                    }
                })
            })
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
            {!! Form::open(['url'=>aurl('states/'.$state->id),'method'=>'put'])!!}

                <div class="form-group">
                    {!! Form::label('state_name_en','State En') !!}
                    {!! Form::text('state_name_en',$state->state_name_en,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('state_name_ar','State Ar') !!}
                    {!! Form::text('state_name_ar',$state->state_name_ar,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country_id','Country Name') !!}
                    {!! Form::select('country_id',App\model\Country::pluck('country_name_en','id')
                    ,$state->country_id,['class'=>'form-control country_id','placeholder'=>'.....']) !!}
                </div>

{{--                <div class="form-group">--}}
{{--                    {!! Form::label('city_id','City Name') !!}--}}
{{--                    {!! Form::select('city_id',App\model\City::pluck('city_name_en','id'),$state->city_id,['class'=>'form-control']) !!}--}}
{{--                </div>--}}

            <div class="form-group">
                {!! Form::label('city_id','City Name') !!}
                <span class="city"></span>
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
