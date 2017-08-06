const elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.script('main.js', 'public/assets/js/main.js');
});
