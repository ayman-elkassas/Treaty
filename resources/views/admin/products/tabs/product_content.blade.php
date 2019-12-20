
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <script type="text/javascript">
        Dropzone.autoDiscover=false;
        $(document).ready(function(){

            $('#mainphoto').dropzone({
                url:"{{aurl('update/image/'.$product->id)}}",
                paramName:'file',
                uploadMultiple:false,
                maxFiles:1,
                maxFilessize:3, //MB
                acceptedFiles:'image/*',
                dictDefaultMessage:'Drop Main Photo here',
                dictRemoveFile:'Remove',
                removedfile:function(file)
                {
                    $.ajax({
                        dataType:'json',
                        type:'post',
                        url:'{{aurl('delete/product/image/'.$product->id)}}',
                        data:{_token:'{{csrf_token()}}'}
                    });

                    var fmock;
                    return (fmock=file.previewElement) !=null?fmock.parentNode.removeChild(file.previewElement):void 0;
                },
                params:{
                    _token:'{{csrf_token()}}'
                },
                addRemoveLinks: true,
                init:function(){

                    @if(!empty($product->photo))

                        var mock={
                                name:'{{$product->title}}'
                                ,size:'{{$file->size}}'
                                ,type:'{{$file->mime_type}}'
                            };
                        this.addFile.call(this,mock);
                        this.options.thumbnail(this,mock,{{url('storage/'.$product->photo)}})
                        $('dz-progress').remove();

                    @endif

                    this.on('sending',function (file,xhr,formData) {
                    formData.append('fid','');
                    file.fid='';

                    });

                    this.on('success',function (file,response) {
                        file.fid=response.id;
                    })
                }
            });

            $('#dropzonefileupload').dropzone({
                url:"{{aurl('upload/image/'.$product->id)}}",
                paramName:'file',
                uploadMultiple:false,
                maxFiles:15,
                maxFilessize:3, //MB
                acceptedFiles:'image/*',
                dictDefaultMessage:'Drop files here to upload',
                dictRemoveFile:'Remove',
                removedfile:function(file)
                {
                    $.ajax({
                        dataType:'json',
                        type:'post',
                        url:'{{aurl('delete/image')}}',
                        data:{_token:'{{csrf_token()}}',id:file.fid}
                    });

                    var fmock;
                    return (fmock=file.previewElement) !=null?fmock.parentNode.removeChild(file.previewElement):void 0;
                },
                params:{
                    _token:'{{csrf_token()}}'
                },
                addRemoveLinks: true,
                init:function(){
                    @foreach($product->files()->get() as $file)
                        var mock={
                            name:'{{$file->name}}'
                            ,fid:'{{$file->id}}'
                            ,size:'{{$file->size}}'
                            ,type:'{{$file->mime_type}}'
                        };
                        this.addFile.call(this,mock);
                        this.options.thumbnail(this,mock,{{url('storage/'.$file->full_size)}})
                    @endforeach

                    this.on('sending',function (file,xhr,formData) {
                        formData.append('fid','');
                        file.fid='';
                        
                    });

                    this.on('success',function (file,response) {
                        file.fid=response.id;
                    })
                }
            });
        });
    </script>
    <style type="text/css">
        .dz-image img{
            width:100px;
            height: 100px;
        }
    </style>
@endpush

<div id="menu2" class="tab-pane fade">
    <h3>Product content</h3>
    <hr>
    <center><h1>Main Photo</h1></center>
    <div class="dropzone" id="mainphoto"></div>
    <hr>
    <center><h1>Additional Photos and Videos</h1></center>
    <div class="dropzone" id="dropzonefileupload"></div>

</div>