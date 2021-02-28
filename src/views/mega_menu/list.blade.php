<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
        <link rel="stylesheet" href="{{asset('assets/megamenu/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css')}}" />
    </head>
    <body>
        <div class="container mt-5">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="d-inline-flex">
                        <select name="" id="" class="form-control">
                            <option value="">Menu 1</option>
                            <option value="">Menu 2</option>
                        </select>
                        <a class="btn btn-sm btn-success text-white ml-4"  href="{{route('NewMenu')}}">Create New Menu</a>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($files as $file)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$file->getFilename()}}</td>
                                <td> <a class="btn btn-sm btn-warning" href="{{route('MenuEdit',$file->getFilename())}}"> <i class="fa fa-eye"></i> </a>
                                    <a class="btn btn-sm btn-danger deleteMenu" type="!#" data-title="{{$file->getFilename()}}"> <i class="fa fa-trash"></i> </a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- the css in the <head> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="{{asset('assets/megamenu/bootstrap-iconpicker/js/iconset/fontawesome5-3-1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/megamenu/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/megamenu/jquery-menu-editor.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/megamenu/jquery-menu-editor.min.js')}}"></script>
        <script>



            $('input[type=file]').change(function () {
            $.ajaxSetup({
            headers: {'X-CSRF-Token': '{{csrf_token()}}'}
            });
                            var file = $(this)[0].files[0];
                            var formData = new FormData();
                           // formData.append('id', id);
                            formData.append('file', file);
                            $.ajax({
                                xhr: function () {
                                    var xhr = new window.XMLHttpRequest();
                                    return xhr;
                                },
                                url: '{{route('MegaMenuImageUpload')}}',
                                type: 'POST',
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (res) {
                                    if(!res.success){
                                       $('#image_label').val(res.ImageUrl)
                                        }
                                }
                            })
                        })



                        $(document).ready(function () {
     $('.deleteMenu').on('click', function(e) {
         var tr = $(this).closest('tr');
                $(".loader").show();
 //$(".deleteCategory").click(function(){
 var name = $(this).data("title");
 $.ajax(
 {
	 url: "{{route('MenuDelete')}}",
	 type: 'post',
	 data: {
		 "name": name,
		 "_token": '{{csrf_token()}}',
	 },
success: function (data) {
                        console.log(data);
                        setTimeout(function () {
                            $(".loader").hide();
                            tr.find('td').fadeOut(980,function(){
                            tr.remove();
                        });
                        }, 300);
                    }


 });
});
});
        </script>
    </body>
</html>
