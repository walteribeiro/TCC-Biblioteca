<div class="datagrid" border="0">
    <table>
        <thead>
        <tr>
            <th style="width: 190px">Título</th>
            <th>Código</th>
            <th>Total de Empréstimos</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dados as $a)
            <tr>
                <td>{{$a->titulo}}</td>
                <td class="alinhar-centro">{{$a->codigo}}</td>
                <td class="alinhar-centro">{{$a->total}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>