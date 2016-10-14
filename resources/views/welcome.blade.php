@extends('layout.main')

@section('conteudo')

    <br><br>

    <!-- top tiles -->
    <div class="row tile_count">
        <div class="col-md-2 col-sm-3 col-xs-6 col-md-offset-2 tile_stats_count">
            <span class="count_top"><i class="fa fa-book"></i> Total de Livros</span>
            <div class="count blue">{{$livros}}</div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-book"></i> Total de Revistas</span>
            <div class="count blue">{{$revistas}}</div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> Total de Autores</span>
            <div class="count blue">{{$autores}}</div>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> Total de Editoras</span>
            <div class="count blue">{{$editoras}}</div>
        </div>
    </div>
    <!-- /top tiles -->

    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-xs-12 col-sm-offset-1">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Atividades Recentes</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">

                        <ul class="list-unstyled timeline">
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de autenticação</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/08/2016</span> por <a>Walter Ribeiro</a>
                                        </div>
                                        <p class="excerpt">Módulo de autenticação adicionado para testes, é necessário
                                            que o usuário
                                            se autentique para acessar o sistema e realizar as alterações de acordo com
                                            seu nível
                                            de permissão. Caso o usuário deixe de utilizar o sistema o mesmo deve sair
                                            para que o
                                            próximo usuário possa acessar com seu nome de usuário e senha.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de mapas</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/08/2016</span> por <a>Mateus Fernandes</a>
                                        </div>
                                        <p class="excerpt">Módulo de mapas adicionado para testes, com ele é
                                            possível
                                            adicionar novos mapas, bem como fazer sua alteração, busca e exclusão.
                                            É
                                            necessário preencher o campo descrição para diferenciar um mapa do
                                            outro, facilitando a identificação no momento da reserva.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de salas</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/08/2016</span> por <a>Walter Ribeiro</a>
                                        </div>
                                        <p class="excerpt">Módulo de salas adicionado para testes, com ele é
                                            possível
                                            adicionar novas salas, bem como fazer sua alteração, busca e exclusão.
                                            É
                                            necessário preencher o campo descrição para diferenciar uma sala da
                                            outra, facilitando a identificação no momento da reserva.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de data-show</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/08/2016</span> por <a>Mateus Fernandes</a>
                                        </div>
                                        <p class="excerpt">Módulo de data shows adicionado para testes, com ele é
                                            possível
                                            adicionar novos data shows, bem como fazer sua alteração, busca e exclusão.
                                            É
                                            necessário preencher o campo descrição para diferenciar um data show do
                                            outro.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de funcionários</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/08/2016</span> por <a>Walter Ribeiro</a>
                                        </div>
                                        <p class="excerpt">Módulo de funcionário adicionado para testes, com ele é
                                            possível
                                            adicionar novos funcionários que também terão permissões para acessar o
                                            sistema caso
                                            necessário. Para adicionar privilégios de usuário a um funcionário basta
                                            preencher os
                                            campos "nome de usuário" e "senha".
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de livros</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/07/2016</span> por <a>Mateus Fernandes</a>
                                        </div>
                                        <p class="excerpt">Módulo de livros adicionado para testes, com ele é possível
                                            adicionar novos livros,
                                            listar os já existentes, excluir e alterar os dados caso seja necessário. É
                                            importante ressaltar que o
                                            sistema divide os livros das revistas, portanto é necessário se assegurar de
                                            que cada exemplar está
                                            sendo cadastrado no local correto.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de editoras</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/07/2016</span> por <a>Walter Ribeiro</a>
                                        </div>
                                        <p class="excerpt">Módulo de editoras adicionado para testes, nesta primeira
                                            versão é necessário acessar a
                                            tela de editoras para realizar seu cadastro antes de cadastrar o livro ou
                                            revista, após a adição da editora
                                            a mesma poderá ser selecionada na tela de cadastro de livros ou de revistas.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de revistas</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/07/2016</span> por <a>Mateus Fernandes</a>
                                        </div>
                                        <p class="excerpt">Módulo de revistas adicionado para testes, com ele é possível
                                            adicionar novas revistas,
                                            listar as já existentes, excluir e alterar os dados caso seja necessário. É
                                            importante ressaltar que o
                                            sistema divide os livros das revistas, portanto é necessário se assegurar de
                                            que cada exemplar está
                                            sendo cadastrado no local correto.
                                        </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="block">
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>Adição do módulo de autores</a>
                                        </h2>
                                        <div class="byline">
                                            <span>07/07/2016</span> por <a>Walter Ribeiro</a>
                                        </div>
                                        <p class="excerpt">Módulo de autores adicionado para testes, nesta primeira
                                            versão é necessário acessar a
                                            tela de autores para realizar seu cadastro antes de cadastrar o livro, após
                                            a adição do autor
                                            o mesmo poderá ser selecionado na tela de cadastro de livros.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @if( !empty(Session::has('alerta')) )
        <script>
            var options = {
                "closeButton": true,
                "positionClass": "toast-top-center",
                "timeOut": "3000"
            };
            toastr.warning('{{Session::get('alerta')}}', 'Atenção!', options);
        </script>
    @endif
@endsection