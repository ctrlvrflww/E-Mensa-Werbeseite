@extends("layouts.anmeldung")

@section("main")
    <div class="mitte">
        <form method="post" action="/anmeldung-verifizieren">
            <label for="email" >E-Mail: </label>
            <input type="text" id="email" name="email" placeholder="Geben sie ihre Email ein" size="28" required>
            <br>
            <br>
            <label for="passwort" >Passwort: </label>
            <input type="password" id="passwort" name="passwort" placeholder="Geben sie ihr Passwort ein" size="25" required>
            <input type="submit" id="submit" name="anmeldung" value="Anmelden">
            <br>
            <div class="red">{{$error}}</div>
        </form>
    </div>
@endsection