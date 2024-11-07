<?php

echo "<h1>a) str_replace</h1>";

$text = "String alt";

echo "alter Text: ". $text. "<br>";

$text_replaced = str_replace("alt", "neu",$text);

echo "ersetzter Text: ". $text_replaced;

echo "<h1>b) str_repeat</h1>";

$text = "Hallo";
echo str_repeat($text,10);


echo "<h1>c) substr</h1>";
echo substr("datenbank", -1). "<br>";
echo substr("datenbank", -2). "<br>";
echo substr("datenbank", -3). "<br>";
echo substr("datenbank", -4). "<br>";
echo substr("datenbank", -5). "<br>";
echo substr("datenbank", -6). "<br>";
echo substr("datenbank", -7). "<br>";
echo substr("datenbank", -8). "<br>";
echo substr("datenbank", -9). "<br>";

echo substr("datenbank", -9,5). "<br>";


echo "<h1>d) trim / ltrim / rtrim</h1>";

$text = "Ein kleiner Satz";
echo $text. "<br>";

echo "<h2>trim Demo: </h2>";
echo trim ($text,"EinSatz"). "<br>";

echo "<h2>ltrim Demo: </h2>";
echo ltrim ($text,"Ein");

echo "<h2>rtrim Demo: </h2>";
echo rtrim ($text,"ztaS");

echo "<h1>e) String-Konkatenation (Aneinanderhaengen von Zeichenketten)</h1>";

echo "Ein ". "kurzer ". "Satz";




?>