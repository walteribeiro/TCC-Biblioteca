@if( isset($errors) && count($errors) > 0)
    <script>
        var options = {
            "closeButton": true,
            "positionClass": "toast-top-center",
            "timeOut": "2000"
        };
        toastr.error('@foreach($errors->all() as $e) <li> {{ $e }} </li> @endforeach', 'Erro!', options);
    </script>
@endif