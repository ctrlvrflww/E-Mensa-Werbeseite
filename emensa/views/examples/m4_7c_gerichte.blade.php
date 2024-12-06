
<body>
@if(isset($gerichte))
    <table>
        <tr><th>Name</th><th>PreisIntern</th></tr>
        @foreach($gerichte as $gericht)
            <tr><td>{{$gericht['name']}}</td><td>{{$gericht['preisintern']}}</td></tr>
        @endforeach
    </table>
@else
    Es sind keine Gerichte vorhanden
@endif
</body>