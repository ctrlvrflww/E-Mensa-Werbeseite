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
                        <td>@if($bewertung[5] == $_SESSION['id'])
                                <form method="post" action="/deletebewertung">
                                    <input type="hidden" name="data" value="{{$bewertung[6]}}">
                                    <input type="submit" name="löschen" value="Löschen">
                                </form>
                            @endif</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection