@extends("layouts.anmeldung")

@section("main")
    <div class="mitte">
        <form method="post">
            <label for="email" >E-Mail: </label>
            <input type="text" id="email" name="email" placeholder="Geben sie ihre Email ein" size="28">
            <br>
            <br>
            <label for="passwort" >Passwort: </label>
            <input type="text" id="passwort" name="passwort" placeholder="Geben sie ihr Passwort ein" size="25">
        </form>
    </div>
@endsection