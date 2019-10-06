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
            {!! Form::open(['url'=>aurl('manufacts'),'files'=>true])!!}

                <input type="hidden" id="lat" name="lat" value="{{$lat}}">
                <input type="hidden" id="lng" name="lng" value="{{$lng}}">

                <div class="form-group">
                    {!! Form::label('name_en','Manufacts name En') !!}
                    {!! Form::text('name_en',old('name_en'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('name_ar','Manufacts name Ar') !!}
                    {!! Form::text('name_ar',old('name_ar'),['class'=>'form-control']) !!}
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
                    {!! Form::label('logo','Manufacts Logo') !!}
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
        <script type="text/javascript" async defer
                src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBVA2e_-l2hX1CJOxhgjQL4Id0N35bUuZM&callback=initMap'></script>

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

            function initMap() {
                var map = new google.maps.Map(document.getElementById('us1'), {
                    zoom: 8,
                    center: {lat: 27.004305008230943, lng: 29.9931640625}
                });
                var geocoder = new google.maps.Geocoder;
                var infowindow = new google.maps.InfoWindow;

                // document.getElementById('submit').addEventListener('click', function() {
                //     geocodeLatLng(geocoder, map, infowindow);
                // });
            }

            // function geocodeLatLng(geocoder, map, infowindow) {
            //     var input = document.getElementById('latlng').value;
            //     var latlngStr = input.split(',', 2);
            //     var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
            //     geocoder.geocode({'location': latlng}, function(results, status) {
            //         if (status === 'OK') {
            //             if (results[0]) {
            //                 map.setZoom(11);
            //                 var marker = new google.maps.Marker({
            //                     position: latlng,
            //                     map: map
            //                 });
            //                 infowindow.setContent(results[0].formatted_address);
            //                 infowindow.open(map, marker);
            //             } else {
            //                 window.alert('No results found');
            //             }
            //         } else {
            //             window.alert('Geocoder failed due to: ' + status);
            //         }
            //     });
            // }
        </script>
    @endpush

@endsection