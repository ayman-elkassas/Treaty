<!-- Button trigger modal -->
<button type="button" class="btn btn-danger single_delete">
    <i class="fa fa-trash"></i>
</button>

<!-- Modal -->
<div id="deleteModal" class="modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {!! Form::open(['url'=>aurl('sizes/'.$id),'method'=>'delete']) !!}
            <div class="modal-body">
                <p>{{trans('admin.delete_this',['admin'=>session('lang')=='ar'?$name_ar:$name_en])}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info cancel_delete" data-dismiss="modal">Close</button>
                {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>

<script>
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