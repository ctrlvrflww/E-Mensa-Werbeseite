@extends("layouts.anmeldung")

@section("main")
    <div class="mitte">
        <form method="post" action="/bewertung-speichern?gerichtid={{$gericht_id}}">
            <h2>Bewertung für {{$name}}</h2>
            @if(!isset($bildname))
                <img src="/img/gerichte/00_image_missing.jpg" alt="dateifehler" width="100" height="100">
            @else
                <img src="/img/gerichte/{{$bildname}}" alt="not found" width="100" height="100">
            @endif
            <br>
            <label for="sterne"> Wie hat dir das Gericht geschmeckt?</label>
            <select id="sterne" name="Sterne">
                <option value="Sehr gut">Sehr gut</option>
                <option value="gut">gut</option>
                <option value="schlecht">schlecht</option>
                <option value="sehr schlecht">sehr schlecht</option>
            </select>
            <br>
            <br>
            <label for="bemerkung" >Hinterlasse uns gerne dein Feedback!: </label>
            <textarea type="text" id="bemerkung" name="bemerkung" rows="7" cols="45" minlength="5" required></textarea>
            <br>
            <br>
            <input type="submit" id="submit" name="bewertung" value="Abschicken">
            <div class="red">{{$error}}</div>
        </form>
    </div>
@endsection