<div class="datagrid" border="0">
    <table>
        <thead>
        <tr>
            <th style="width: 190px">Nome</th>
            <th style="width: 100px">Nº Registro</th>
            <th>Telefone</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Total de Empréstimos</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dados as $a)
            <tr>
                <td>{{$a->nome}}</td>
                <td class="alinhar-centro">{{$a->matricula}}</td>
                <td class="alinhar-centro">{{$a->telefone}}</td>
                <td class="alinhar-centro">{{$a->telefone2}}</td>
                <td class="alinhar-centro">{{$a->email}}</td>
                <td class="alinhar-centro">{{$a->total}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>