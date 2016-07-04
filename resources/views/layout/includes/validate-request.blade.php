@if( isset($errors) && count($errors) > 0)
    <script>
        new PNotify({
            title: 'Erro!',
            text: '@foreach($errors->all() as $e) {{ $e }} @endforeach',
            type: 'error',
            styling: 'bootstrap3'
        });
    </script>
@endif