@if( isset($errors) && count($errors) > 0)
    <script>
        var options = {
            "closeButton": true
        };
        toastr.error('@foreach($errors->all() as $e) <li> {{ $e }} </li> @endforeach', 'Erro!', options);
    </script>
@endif