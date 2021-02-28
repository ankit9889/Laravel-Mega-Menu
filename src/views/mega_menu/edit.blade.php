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
                        <select name="" id="">
                            <option value="">Menu 1</option>
                            <option value="">Menu 2</option>
                        </select>
                        <a class="btn btn-sm btn-success text-white ml-4" href="{{route('NewMenu')}}">Create New Menu</a>
                        <a class="btn btn-sm btn-success text-white ml-4"  href="{{route('MenuList')}}">Menu List</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-primary mb-3">
                        <div class="card-header bg-primary text-white">Edit item</div>
                        <div class="card-body">
                            <form id="frmEdit" class="form-horizontal">
                                <div class="form-group">
                                    <label for="text">Text</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text" />
                                        <div class="input-group-append">
                                            <button type="button" id="myEditor_icon" class="btn btn-outline-secondary"></button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="icon" class="item-menu" />
                                </div>
                                <div class="form-group">
                                    <label for="href">Image</label>
                                    <div class="input-group">
                                        <input type="text" id="image_label" class="form-control item-menu" name="image" />
                                        <input type="file" class="btn btn-outline-secondary" id="button-image" style="width: 21%; padding: 3px;" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="href">URL</label>
                                    <input type="text" class="form-control item-menu" id="href" name="href" placeholder="URL" />
                                </div>
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <select name="target" id="target" class="form-control item-menu">
                                        <option value="_self">Self</option>
                                        <option value="_blank">Blank</option>
                                        <option value="_top">Top</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">Tooltip</label>
                                    <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip" />
                                </div>
                                <input type="hidden" id="file_name" value="{{$name}}">
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="btnUpdate" class="btn btn-primary" disabled><i class="fas fa-sync-alt"></i> Update</button>
                            <button type="button" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <button id="btnOut" type="button" class="btn btn-success">
                        <i class="glyphicon glyphicon-ok"></i><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"> Save</font></font>
                    </button>
                    <ul id="myEditor" class="sortableLists list-group"></ul>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <textarea id="out" class="form-control" cols="50" rows="10"></textarea>
                    </div>

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
            var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
            // sortable list options
            var sortableListOptions = {
                placeholderCss: {'background-color': "#cccccc"}
            };
            var editor = new MenuEditor('myEditor',
                        {
                        listOptions: sortableListOptions,
                        iconPicker: iconPickerOptions,
                        maxLevel: 10 // (Optional) Default is -1 (no level limit)
                        // Valid levels are from [0, 1, 2, 3,...N]
                        });
            editor.setForm($('#frmEdit'));
            editor.setUpdateButton($('#btnUpdate'));
            //Calling the update method
            $("#btnUpdate").click(function(){
                editor.update();
            });
            // Calling the add method
            $('#btnAdd').click(function(){
                editor.add();
            });

            var arrayjsons ={!! $data !!};
            editor.setData(arrayjsons);

            $('#btnOut').click(function(){
            var str = editor.getString();
            var file_name=$('#file_name').val();
            $("#out").text(str);

            $.ajax({
                        url: "{{route('MenuUpdate')}}",
                        type: "Post",
                        data: {
                            'jsonMenu': str,'file_name':file_name,
                            _token: "{{csrf_token()}}",
                        },
                        success: function (data) {
                            alert(data.success);
                            window.location.reload();
                        },
                    });
            });


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
        </script>
    </body>
</html>
