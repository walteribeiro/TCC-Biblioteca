@if( !empty(Session::has('erro')) )
    <script>
        var options = {
            "closeButton": true
        };
        toastr.error('{{Session::get('erro')}}', 'Erro!', options);
    </script>
@endif
@if( !empty(Session::has('sucesso')) )
    <script>
        var options = {
            "closeButton": true
        };
        toastr.success('{{Session::get('sucesso')}}', 'Sucesso!', options);
    </script>
@endif