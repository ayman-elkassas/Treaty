<div id="menu4" class="tab-pane fade in active">
    <h3>Addition info</h3>

    <div class="form-group">
        {!! Form::label('title','Title') !!}
        {!! Form::text('title',$product->title,['class'=>'form-control','placeholder'=>'Title']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('content','Content') !!}
        {!! Form::textarea('content',$product->content,['class'=>'form-control','placeholder'=>'Title']) !!}
    </div>

</div>