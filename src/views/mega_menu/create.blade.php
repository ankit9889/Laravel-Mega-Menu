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
                        <a class="btn btn-sm btn-success text-white ml-4"  href="{{route('MenuList')}}">Menu List</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                            <form action="{{route('StoreNewMegaMenu')}}" method="POST" id="newMenu" class="form-horizontal">
                            @csrf
                    <div class="card border-primary mb-3">
                        <div class="card-header bg-primary text-white">Edit item</div>
                        <div class="card-body">
                                <div class="form-group">
                                    <label for="text">Enter Menu Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control item-menu" name="menu_name" id="menu_name" placeholder="Text" />
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="btnAdd" class="btn btn-success"><i class="fas fa-plus"></i> Create</button>
                        </div>
                    </div>
                            </form>
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
    </body>
</html>
