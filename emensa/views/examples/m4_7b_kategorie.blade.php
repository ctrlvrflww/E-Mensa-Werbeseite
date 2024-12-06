<head>
    <style>
        li:nth-child(even) {
            font-weight: bold;
        }
    </style>
</head>
<body>
<ul>
    @foreach($kategorien as $entry)
        <li>{{$entry['name']}}</li>
    @endforeach
</ul>
</body>