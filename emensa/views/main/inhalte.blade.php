@extends("layouts.hauptlayout")

@section("header")
    <header class="grid-3">
        <div>
            <img src="logo-studentenwerk.png" alt="E-Mensa Logo" width="100">
        </div>
        <div id="top">
            <a href="#ankündigung"> Ankündigung</a>
            <a href="#speisen"> Speisen</a>
            <a href="#zahlen">Zahlen</a>
            <a href="#kontakt">Kontakt</a>
            <a href="#infos">Wichtige für Uns</a>
        </div>
    </header>
@endsection

@section("begrüßungstext")
    <div class="mitte" id="ankündigung">
        <h2>Bald gibt es Essen auch online ;)</h2>
        <p id="Textblock">
            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
        </p>
    </div>
@endsection

@section("gerichte")
    <div class="mitte" id="speisen">
        <h2>Köstlichkeiten, die Sie erwarten</h2>
        <!--<p>aktuelle Sortierung:</p> <?php echo "order:". $orderby . " Reihenfolge: " . $direction?> -->
        <table>
            <tr><th>Name</th><th>Preis intern</th><th>Preis extern</th></tr>
            @foreach ($gerichte as $gericht)
            <tr>
                <td>{{$gericht['name']}}</td>
                <td>{{$gericht['preisintern']}}</td>
                <td>{{$gericht['preisextern']}}</td>
            </tr>
            @endforeach
        </table>
        <br>
    </div>
@endsection

@section("footer")
    <footer class="grid-3" id="kontakt">
        <div class="mitte">
            <ul class="horizontal">
                <li>(c) E-mensa GmbH</li>
                <li> Ihr Name hier</li>
                <li><a href="Lasagne.jpg">Impressum</a></li>
            </ul>
        </div>
    </footer>
@endsection