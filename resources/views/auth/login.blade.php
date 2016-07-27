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

            <form method="POST" action="{{ url('/login') }}">
                {!! csrf_field() !!}
                <h1>EEAC</h1>
                <div>
                    <label class="pull-left" for="username">Nome de Usuário</label>
                    <input type="text" id="username" class="form-control" name="username" autofocus
                           value="{{ old('username') }}">
                </div>
                <div>
                    <label class="pull-left" for="password">Senha</label>
                    <input id="password" type="password" class="form-control" name="password">
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