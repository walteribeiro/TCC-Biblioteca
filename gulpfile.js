var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.browserify('main.js', 'public/assets/js/main.js');
});
