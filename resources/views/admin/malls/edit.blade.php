@extends('admin.master')

@section('content')

	<?php
        $lat=!empty(old('lat'))?old('lat'):27.004305008230943;
        $lng=!empty(old('lng'))?old('lng'):29.9931640625;
	?>

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
            {!! Form::open(['url'=>aurl('malls/'.$malls->id),'files'=>true,'method'=>'put'])!!}

                <input type="hidden" id="lat" name="lat" value="{{$lat}}">
                <input type="hidden" id="lng" name="lng" value="{{$lng}}">

                <div class="form-group">
                    {!! Form::label('name_en','Malls En') !!}
                    {!! Form::text('name_en',$malls->name_en,['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name_ar','Malls Ar') !!}
                    {!! Form::text('name_ar',$malls->name_ar,['class'=>'form-control']) !!}
                </div>

            <div class="form-group">
                {!! Form::label('country_id','Country name') !!}
                {!! Form::select('country_id',\App\model\Country::pluck('country_name_'.session('lang'),'id'),$malls->country_id,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('contact_name','contact_name') !!}
                {!! Form::text('contact_name',$malls->contact_name,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email','Email') !!}
                {!! Form::email('email',$malls->email,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('mobile','Mobile') !!}
                {!! Form::text('mobile',$malls->mobile,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address','Address') !!}
                {!! Form::text('address',$malls->address,['class'=>'form-control','id'=>'address']) !!}
            </div>

            {{--                map--}}
            <div class="form-group">
                <div id="us1" style="width:100%;height: 400px;"></div>
            </div>

            <div class="form-group">
                {!! Form::label('facebook','facebook') !!}
                {!! Form::text('facebook',$malls->facebook,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('twitter','twitter') !!}
                {!! Form::text('twitter',$malls->twitter,['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('website','Website') !!}
                {!! Form::text('website',$malls->website,['class'=>'form-control']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('logo','Malls Logo') !!}
                    {!! Form::file('logo',['class'=>'form-control']) !!}
                </div>

                @if(!empty($malls->logo))
                    <img src="{{Storage::url($malls->logo)}}" style="width: 5%;height: 5%;"/>
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

    @push('js')
        {{--        <script async defer--}}
        {{--                src='https://maps.googleapis.com/maps/api/js?key=AIzaSyB6d764357eLB6Ox79IWkelWVeYxRkwV-Q&callback=initMap'>--}}
        {{--        </script>--}}
        <script type="text/javascript"
                src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyCcaWv2Qaj-wZ0QihtoWG4P6LK10455B9E'></script>

        <script type="text/javascript" src='{{url('design/jquery-locationpicker/locationpicker.jquery.js')}}'></script>

        <script type="text/javascript">
            $('#us1').locationpicker({
                location: {
                    latitude: {{$lat}}
                    , longitude: {{$lng}}
                },
                radius: 300,
                markerIcon: '{{url('image/map-marker-2-xl.png')}}',
                inputBinding: {
                    latitudeInput: $('#lat'),
                    longitudeInput: $('#lng')
                },
                //radiusInput: $('#us2-radius'),
                locationNameInput: $('#address'),
            });
        </script>
    @endpush

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
