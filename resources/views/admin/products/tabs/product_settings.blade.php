
@push('js')
    <script type="text/javascript">
        $('.datepicker').datepicker({
            rtl:'{{session('lang')=='ar'?true:false}}',
            language:'{{session('lang')}}',
            dateFormate:'YYYY-mm-dd',
            autoclose:false,
            todayBtn:true,
            clearBtn:true
        });

        $(document).on('change','.status',function () {
            var status=$('.status option:selected').val();
            if(status=='refused')
            {
                $('.reason').removeclass('hidden');
            }else
            {
                $('.reason').addclass('hidden');
            }
        })

    </script>
@endpush

<div id="menu1" class="tab-pane fade">
    <h3>Product settings</h3>

    <div class="form-group col-sm-3 col-xs-12 col-md-3 col-lg-3">
        {!! Form::label('price','Price') !!}
        {!! Form::text('price',$product->price,['class'=>'form-control','placeholder'=>'Price']) !!}
    </div>

    <div class="form-group col-sm-3 col-xs-12 col-md-3 col-lg-3">
        {!! Form::label('stock','stock') !!}
        {!! Form::text('stock',$product->stock,['class'=>'form-control','placeholder'=>'stock']) !!}
    </div>

    <div class="form-group col-sm-3 col-xs-12 col-md-3 col-lg-3">
        {!! Form::label('start_at','start_at') !!}
        {!! Form::text('start_at',$product->start_at,['class'=>'form-control datepicker','placeholder'=>'start_at']) !!}
    </div>

    <div class="form-group col-sm-3 col-xs-12 col-md-3 col-lg-3">
        {!! Form::label('end_at','end At') !!}
        {!! Form::text('end_at',$product->end_at,['class'=>'form-control','placeholder'=>'end_at']) !!}
    </div>

    <div class="clearfix"></div>
    <hr>

    <div class="form-group col-sm-4 col-xs-12 col-md-4 col-lg-4">
        {!! Form::label('price_offer','price Offer') !!}
        {!! Form::text('price_offer',$product->price_offer,['class'=>'form-control','placeholder'=>'price_offer']) !!}
    </div>

    <div class="form-group col-sm-4 col-xs-12 col-md-4 col-lg-4">
        {!! Form::label('start_offer_at','start offer at') !!}
        {!! Form::text('start_offer_at',$product->start_offer_at,['class'=>'form-control datepicker','placeholder'=>'start_offer_at']) !!}
    </div>

    <div class="form-group col-sm-4 col-xs-12 col-md-4 col-lg-4">
        {!! Form::label('end_offer_at','end Offer At') !!}
        {!! Form::text('end_offer_at',$product->end_offer_at,['class'=>'form-control datepicker','placeholder'=>'end_offer_at']) !!}
    </div>

    <div class="clearfix"></div>
    <hr>

    <div class="form-group status hidden">
        {!! Form::label('status','status') !!}
        {!! Form::select('status',['pending'=>'pending','refused'=>'refused','active'=>'active'],
        $product->status,['class'=>'form-control','placeholder'=>'status']) !!}
    </div>

    <div class="form-group reason {{$product->status!='refused'?'hidden':''}}">
        {!! Form::label('reason','reason') !!}
        {!! Form::textarea('reason',$product->reason,['class'=>'form-control','placeholder'=>'reason']) !!}
    </div>

</div>