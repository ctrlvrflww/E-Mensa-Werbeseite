@extends("layouts.anmeldung")

@section("main")
    <div class="mitte">
        <form method="post" action="/anmeldung-verifizieren">
            <h2>Bewertung</h2>
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
            <textarea type="text" id="bemerkung" name="bemerkung" rows="7" cols="45" required>
            </textarea>
            <br>
            <br>
            <input type="submit" id="submit" name="bewertung" value="Abschicken">
            <div class="red">{{$error}}</div>
        </form>
    </div>
@endsection