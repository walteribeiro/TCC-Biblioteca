@if( !empty(Session::has('erro')) )
    <script>
        new PNotify({
            delay: 500,
            title: 'Erro!',
            text: '{{Session::get('erro')}}',
            type: 'error',
            styling: 'bootstrap3'
        });
    </script>
@endif
@if( !empty(Session::has('sucesso')) )
    <script>
        new PNotify({
            title: 'Sucesso!',
            text: '{{Session::get('sucesso')}}',
            type: 'success',
            styling: 'bootstrap3'
        });
    </script>
@endif