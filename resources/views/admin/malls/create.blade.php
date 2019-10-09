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
            {!! Form::open(['url'=>aurl('malls'),'files'=>true])!!}

                <input type="hidden" id="lat" name="lat" value="{{$lat}}">
                <input type="hidden" id="lng" name="lng" value="{{$lng}}">

                <div class="form-group">
                    {!! Form::label('name_en','Malls name En') !!}
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name_ar','Malls name Ar') !!}
                    {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country_id','Country name') !!}
                    {!! Form::select('country_id',\App\model\Country::pluck('country_name_'.session('lang'),'id'),old('country_id'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('contact_name','contact_name') !!}
                    {!! Form::text('contact_name',old('contact_name'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email','Email') !!}
                    {!! Form::email('email',old('email'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('mobile','Mobile') !!}
                    {!! Form::text('mobile',old('mobile'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('address','Address') !!}
                    {!! Form::text('address',old('address'),['class'=>'form-control','id'=>'address']) !!}
                </div>

{{--                map--}}
                <div class="form-group">
                    <div id="us1" style="width:100%;height: 400px;"></div>
                </div>

                <div class="form-group">
                    {!! Form::label('facebook','facebook') !!}
                    {!! Form::text('facebook',old('facebook'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('twitter','twitter') !!}
                    {!! Form::text('twitter',old('twitter'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('website','Website') !!}
                    {!! Form::text('website',old('website'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('logo','Malls Logo') !!}
                    {!! Form::file('logo',old('logo'),['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

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