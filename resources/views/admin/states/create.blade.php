@extends('admin.master')

@section('content')

    @push('js')
        <script type="text/javascript">
            $(function () {

                //if country_id has old value in wrong input
                @if(old('country_id'))
                    $.ajax({
                        url:'{{aurl('states/create')}}',
                        type:'get',
                        datatype:'html',
                        data:{country_id:'{{old('country_id')}}',select:'{{old('city_id')}}'},
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
            {!! Form::open(['url'=>aurl('states')])!!}

                <div class="form-group">
                    {!! Form::label('state_name_en','State En') !!}
                    {!! Form::text('state_name_en',old('state_name_en'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('state_name_ar','State Ar') !!}
                    {!! Form::text('state_name_ar',old('state_name_ar'),['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('country_id','Country Name') !!}
                    {!! Form::select('country_id',App\model\Country::pluck('country_name_en','id')
                    ,old('country_id'),['class'=>'form-control country_id','placeholder'=>'.....']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('city_id','City Name') !!}
                    <span class="city"></span>
                </div>

                {!! Form::submit('Save',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

@endsection