@if( !empty(Session::has('erro')) )
    <script>
        var options = {
            "closeButton": true,
            "positionClass": "toast-top-center",
            "timeOut": "2000"
        };
        toastr.error('{{Session::get('erro')}}', 'Erro!', options);
    </script>
@endif
@if( !empty(Session::has('sucesso')) )
    <script>
        var options = {
            "closeButton": true,
            "positionClass": "toast-top-center",
            "timeOut": "2000"
        };
        toastr.success('{{Session::get('sucesso')}}', 'Sucesso!', options);
    </script>
@endif