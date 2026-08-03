<table class="table table-responsive table-striped" id="formation-table">
    <thead>
        <tr align="center">
          <th>MOYEN DE TRANSPORT</th>
          <th>EFF JOURNALIER</th>
        </tr>
    </thead>
    <tbody>
    @foreach($pratique as $key => $moyen)
        <tr align="center">
            <td>{{empty($key) ? 'RETUNUS S.P':$key}}</td>
            <td>{{$moyen->where('admis', true)->count()}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>MOYEN DE TRANSPORT</th>
            <th>EFF JOURNALIER</th>
        </tr>
    </tfoot>
</table>
