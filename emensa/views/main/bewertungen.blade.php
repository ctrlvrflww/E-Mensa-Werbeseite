@extends("layouts.anmeldung")

@section("main")
    <div class="mitte">
        <table>
            <thead>
            <tr><th>Gericht</th><th>Bewertung</th><th>Bemerkung</th><th>Author</th><th>Datum</th></tr>
            </thead>
            <tbody>
                @foreach($bewertungen as $bewertung)
                    <tr
                    @if($bewertung[7]) @php echo 'class="highlighted"'@endphp @endif>
                        <td>{{$bewertung[0]}}</td>
                        <td>{{$bewertung[1]}}</td>
                        <td>{{$bewertung[2]}}</td>
                        <td>{{$bewertung[3]}}</td>
                        <td>{{$bewertung[4]}}</td>
                        <td>
                            @if(isset($_SESSION['admin']) && $_SESSION['admin'] && !$bewertung[7])
                                <form method="post" action="/highlight">
                                    <input type="hidden" name="highlight" value="{{$bewertung[6]}}" >
                                    <input type="submit" name="hervorheben" value="Hervorheben">
                                </form>
                            @endif
                                @if(isset($_SESSION['admin']) && $_SESSION['admin'] && $bewertung[7])
                                    <form method="post" action="/nohighlight">
                                        <input type="hidden" name="highlight" value="{{$bewertung[6]}}" >
                                        <input type="submit" name="hervorheben" value="Hervorheben abwählen">
                                    </form>
                                @endif
                            @if(isset($_SESSION['id']) && $bewertung[5] == $_SESSION['id'])
                                <form method="post" action="/deletebewertung">
                                    <input type="hidden" name="data" value="{{$bewertung[6]}}">
                                    <input type="submit" name="löschen" value="Löschen">
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection