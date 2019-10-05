@extends('admin.master')

@section('content')

    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
{{--            jstree--}}
            <a href="#" class="btn btn-info edit_dep showbtn_control hidden">
                <i class="fa fa-edit"> Edit</i>
            </a>

            <a href="#" class="btn btn-danger delete_dep showbtn_control hidden btn btn-danger single_delete">
                <i class="fa fa-trash"> Delete</i>
            </a>

            <div id="jstree"></div>

        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

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

                {!! Form::open(['url'=>'','method'=>'delete','id'=>'form_delete_dept']) !!}
                <div class="modal-body">
                    <p>Do you want to delete <span style="font-style: italic" id="dep_name"></span> Sure ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info cancel_delete" data-dismiss="modal">Close</button>
                    {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

    @push('js')
        <script type="text/javascript">
            $(function () {
                $('#jstree').jstree({
                    "core" : {
                        "themes" : {
                            "variant" : "large"
                        },
                        'data' :{!! load_dep() !!},
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
                        name.push(data.instance.get_node(data.selected[i]).text);
                    }
                    $('#form_delete_dept').attr('action','{{aurl('departments')}}/'+r.join(', '));
                    $('#dep_name').text(name,'{{aurl('departments')}}/'+r.join(', '));
                    if(r.join(', ')!='')
                    {
                        $('.showbtn_control').removeClass('hidden');
                        $('.edit_dep').attr('href','{{aurl('departments')}}/'+r.join(', ')+'/edit');
                    }
                    else {
                        $('showbtn_control').addClass('hidden');
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

@endsection