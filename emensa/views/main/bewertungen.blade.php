@extends("layouts.anmeldung")

@section("main")
    <div class="mitte">
        <table>
            <thead>
            <tr><th>Gericht</th><th>Bewertung</th><th>Bemerkung</th><th>Author</th><th>Datum</th></tr>
            </thead>
            <tbody>
                @foreach($bewertungen as $bewertung)
                    <tr>
                        <td>{{$bewertung[0]}}</td>
                        <td>{{$bewertung[1]}}</td>
                        <td>{{$bewertung[2]}}</td>
                        <td>{{$bewertung[3]}}</td>
                        <td>{{$bewertung[4]}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection