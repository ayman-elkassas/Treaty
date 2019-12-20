@push('js')
    <script type="text/javascript">
        $(function () {
            $('#jstree').jstree({
                "core" : {
                    "themes" : {
                        "variant" : "large"
                    },
                    'data' :{!! load_dep($product->department_id) !!},
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
                    //name.push(data.instance.get_node(data.selected[i]).text);
                }
                $('#department_id').val(r.join(', '));
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

<div id="menu0" class="tab-pane fade">
    <h3>Department</h3>

    <div id="jstree"></div>
    <input type="hidden" name="department_id" class="department_id">

</div>