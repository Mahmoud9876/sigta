<table class="table table-responsive table-striped " id="selection-table">
    <thead>
        <tr>
          <th>MOYEN DE TRANSPORT</th>
            <th>EFF PRATIQUE</th>
            <th>EFF THEORIQUE</th>
        </tr>
    </thead>
    <tbody>
    @foreach($theorique as $key => $moyen)
        <tr >
            <td>{{$key}}</td>
            <td>{{ $pratique->has($key) ? $pratique->get($key)->count() : 0}}</td>
            <td>{{$moyen->count()}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>MOYEN DE TRANSPORT</th>
            <th>EFF PRATIQUE</th>
            <th>EFF THEORIQUE</th>
        </tr>
    </tfoot>
</table>
