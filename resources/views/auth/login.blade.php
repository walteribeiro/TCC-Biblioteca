<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">

</head>

<body class="login">
<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">

            <form class="form-horizontal form-label-left" method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <h1>EEAC</h1>
                <div class="form-group">


                    <div>
                        <label class="pull-left" for="username">Nome de Usuário</label>
                        <br><br>
                        <input type="text" id="username" class="form-control" name="username" autofocus value="{{ old('username') }}">
                    </div>
                </div>

                <div class="form-group">

                    <div class="input-group">
                        <label class="pull-left" for="password">Senha</label>
                    </div>

                    <div class="input-group">
                        <input id="password" type="password" class="form-control" name="password">
                        <span class="input-group-btn">
                            <button id="ver" style="margin-top: -14px" type="button" class="btn btn-default">
                                <em id="icone" class="fa fa-eye-slash"></em>
                            </button>
                        </span>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-dark submit btn-block">
                        <i class="fa fa-btn fa-sign-in"></i> Login
                    </button>
                </div>
                <br>
                <div class="separator"></div>
            </form>
        </section>
    </div>
</div>

<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/toastr.js')}}"></script>

<script>
    var senha = $('#password');
    var olho = $("#ver");
    var icone = $('#icone');

    olho.mousedown(function() {
        senha.attr("type", "text");
        icone.removeClass('fa-eye-slash');
        icone.addClass('fa-eye');
    });

    olho.mouseup(function() {
        senha.attr("type", "password");
        icone.removeClass('fa-eye');
        icone.addClass('fa-eye-slash');
    });
</script>

@if( isset($errors) && count($errors) > 0)
    <script type="text/javascript">

        var options = {
            "closeButton": true,
            "positionClass": "toast-top-center",
        };
        toastr.error('@foreach($errors->all() as $e) <li> {{ $e }} </li> @endforeach', 'Erro!', options);
    </script>
@endif

</body>
</html>