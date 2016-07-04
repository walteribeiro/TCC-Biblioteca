@if( isset($errors) && count($errors) > 0)
    <script>
        new PNotify({
            title: 'Erro!',
            text: '@foreach($errors->all() as $e) <li> {{ $e }} </li> @endforeach',
            type: 'error',
            styling: 'bootstrap3'
        });
    </script>
@endif