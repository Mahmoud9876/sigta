<table>
    <caption>Point de situation du {{ now() }}</caption>
    <thead>
        <tr>
            <th colspan="8">SITUATION DU {{ now()->format('Y-m-d') }}</th>
        </tr>
        <tr>
            <th>Date de présentation</th>
            <th>Effectif Théorique</th>
            <th>Effectif Présenté</th>
            <th>Effectif Absent</th>
            <th>Admis</th>
            <th>Moyens de transport</th>
            <th>Utilisé</th>
            <th>Prévu</th>
        </tr>
    </thead>
    <tbody>
        {{-- CAR DE LIGNE --}}
        <tr>
            <td>{{ now()->format('Y-m-d') }}</td>
            <td>{{ $effTheoriqueNow }}</td>
            <td>{{ $effPresenteNow }}</td>
            <td>{{ $effAbsentNow }}</td>
            <td>{{ $effAdmisNow }}</td>
            <td>CAR DE LIGNE</td>
            <td>{{ $moyenCarUtilise }}</td>
            <td>Navette : {{ $moyenCarPrevuNavette }}</td>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>ONCF : {{ $moyenCarPrevuOncf }}</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Propre moyen : {{ $moyenCarPrevuPropreMoyen }}</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Car de Ligne : {{ $moyenCarPrevuCar }}</td></tr>

        {{-- NAVETTE --}}
        <tr>
            <td></td><td></td><td></td><td></td><td></td><td>NAVETTE</td><td>{{ $moyenNavetteUtilise }}</td>
            <td>Navette : {{ $moyenNavettePrevuNavette }}</td>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>ONCF : {{ $moyenNavettePrevuOncf }}</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Propre moyen : {{ $moyenNavettePrevuPropreMoyen }}</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Car de Ligne : {{ $moyenNavettePrevuCar }}</td></tr>

        {{-- ONCF --}}
        <tr>
            <td></td><td></td><td></td><td></td><td></td><td>ONCF</td><td>{{ $moyenOncfUtilise }}</td>
            <td>Navette : {{ $moyenOncfPrevuNavette }}</td>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>ONCF : {{ $moyenOncfPrevuOncf }}</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Propre moyen : {{ $moyenOncfPrevuPropreMoyen }}</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Car de Ligne : {{ $moyenOncfPrevuCar }}</td></tr>

        {{-- PROPRE MOYEN --}}
        <tr>
            <td></td><td></td><td></td><td></td><td></td><td>PROPRE MOYEN</td><td>{{ $moyenPropreMoyenUtilise }}</td>
            <td>Navette : {{ $moyenPropreMoyenPrevuNavette }}</td>
        </tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>ONCF : {{ $moyenPropreMoyenPrevuOncf }}</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Propre moyen : {{ $moyenPropreMoyenPrevuPropreMoyen }}</td></tr>
        <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>Car de Ligne : {{ $moyenPropreMoyenPrevuCar }}</td></tr>

        <tr>
            <td>TOTAL</td>
            <td>{{ $effTheoriqueNow }}</td>
            <td>{{ $effPresenteNow }}</td>
            <td>{{ $effAbsentNow }}</td>
            <td>{{ $effAdmisNow }}</td>
            <td></td><td></td><td></td>
        </tr>
    </tbody>
</table>

<br><br>

<table>
    <caption>SITUATION GLOBALE</caption>
    <thead>
        <tr>
            <th></th>
            <th>CONVOQUES</th>
            <th>PRESENTES</th>
            <th>ADMIS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>TOTAL</th>
            <td>{{ $effTheoriqueGlobal }}</td>
            <td>{{ $effPresenteGlobal }}</td>
            <td>{{ $effAdmisGlobal }}</td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>Moyens de transport</th>
            <th>Prévu</th>
            <th>Utilisé</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>CAR DE LIGNE</td><td>Car de Ligne : {{ $moyenCarPrevuCarGlobal }}</td><td>{{ $moyenCarUtiliseGlobal }}</td></tr>
        <tr><td></td><td>Navette : {{ $moyenCarPrevuNavetteGlobal }}</td><td></td></tr>
        <tr><td></td><td>ONCF : {{ $moyenCarPrevuOncfGlobal }}</td><td></td></tr>
        <tr><td></td><td>Propre moyen : {{ $moyenCarPrevuPropreMoyenGlobal }}</td><td></td></tr>

        <tr><td>NAVETTE</td><td>Navette : {{ $moyenNavettePrevuNavetteGlobal }}</td><td>{{ $moyenNavetteUtiliseGlobal }}</td></tr>
        <tr><td></td><td>ONCF : {{ $moyenNavettePrevuOncfGlobal }}</td><td></td></tr>
        <tr><td></td><td>Propre moyen : {{ $moyenNavettePrevuPropreMoyenGlobal }}</td><td></td></tr>
        <tr><td></td><td>Car de Ligne : {{ $moyenNavettePrevuCarGlobal }}</td><td></td></tr>

        <tr><td>ONCF</td><td>Navette : {{ $moyenOncfPrevuNavetteGlobal }}</td><td>{{ $moyenOncfUtiliseGlobal }}</td></tr>
        <tr><td></td><td>ONCF : {{ $moyenOncfPrevuOncfGlobal }}</td><td></td></tr>
        <tr><td></td><td>Propre moyen : {{ $moyenOncfPrevuPropreMoyenGlobal }}</td><td></td></tr>
        <tr><td></td><td>Car de Ligne : {{ $moyenOncfPrevuCarGlobal }}</td><td></td></tr>

        <tr><td>PROPRE MOYEN</td><td>Navette : {{ $moyenPropreMoyenPrevuNavetteGlobal }}</td><td>{{ $moyenPropreMoyenUtiliseGlobal }}</td></tr>
        <tr><td></td><td>ONCF : {{ $moyenPropreMoyenPrevuOncfGlobal }}</td><td></td></tr>
        <tr><td></td><td>Propre moyen : {{ $moyenPropreMoyenPrevuPropreMoyenGlobal }}</td><td></td></tr>
        <tr><td></td><td>Car de Ligne : {{ $moyenPropreMoyenPrevuCarGlobal }}</td><td></td></tr>
    </tbody>
</table>
