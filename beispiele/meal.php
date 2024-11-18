<!--
- Praktikum DBWT. Autoren:
- Anton, Schindler, 3621756
- Louis (Louisa), Rothmann, 3568758
- Team 301
-->

<?php
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_STARS = 'top/flopp';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';
const GET_PARAM_SPRACHE = 'sprache';

/**
 * List of all allergens.
 */
if(isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] == 'en')
{
    $allergens = [
        11 => 'Gluten',
        12 => 'Crustaceans',
        13 => 'Eggs',
        14 => 'Fish',
        17 => 'Milk'
    ];
}
else
{
    $allergens = [
        11 => 'Gluten',
        12 => 'Krebstiere',
        13 => 'Eier',
        14 => 'Fisch',
        17 => 'Milch'
    ];
}

if(isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] == 'en')
{
    $meal = [
        'name' => 'Sweet potato pockets filled with cream cheese and herbs',
        'description' => 'The sweet potatoes are carefully cut open and the cream cheese is poured in.',
        'price_intern' => 2.90,
        'price_extern' => 3.90,
        'allergens' => [11, 13],
        'amount' => 42             // Number of available meals
    ];
}
else
{
    $meal = [
        'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
        'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
        'price_intern' => 2.90,
        'price_extern' => 3.90,
        'allergens' => [11, 13],
        'amount' => 42             // Number of available meals
    ];
}


$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];


$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (str_contains(strtolower($rating['text']),strtolower($searchTerm)) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_STARS])) {
    $topflopp = $_GET[GET_PARAM_STARS];
    $max = 0;
    $min = 6;
    foreach ($ratings as $rating) {
        if($rating['stars'] > $max) {$max = $rating['stars'];}
        if($rating['stars'] < $min) {$min = $rating['stars'];}
    }
    foreach ($ratings as $rating) {
        if ($topflopp == "TOP" && $rating['stars'] == $max) {
            $showRatings[] = $rating;
        }
        elseif ($topflopp == "FLOPP" && $rating['stars'] == $min) {
            $showRatings[] = $rating;
        }
    }
}else {
    $showRatings = $ratings;
}

function calcMeanStars(array $ratings) : float {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}

?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8"/>
        <title>
            <?php
            if(isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] == 'en')
            {
                echo "Meal: ".$meal['name'];
            } else { echo "Gericht: ".$meal['name'];}
            ?>
        </title>
        <style>
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
        <?php
        if(isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] == 'en')
        {
            echo "<h1>Meal: ".$meal['name']."</h1>";
        } else { echo "<h1>Gericht: ".$meal['name']."</h1>";}

        if (isset($_GET[GET_PARAM_SHOW_DESCRIPTION]))
        {
            $bool = $_GET[GET_PARAM_SHOW_DESCRIPTION];
            if($bool !== 0 && !empty($bool))
            {echo "<p>". $meal['description']. "</p>";}
        } else { echo "<p>". $meal['description']. "</p>";}



        if(!empty($meal['allergens']))
        {
            if(isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] == 'en')
            {
                echo "Price intern: ".number_format($meal['price_intern'], 2)."€<br>Price extern: ".number_format($meal['price_extern'], 2)."€<br><br>Allergens: <ul>\n";
            } else {echo "Preis intern: ".number_format($meal['price_intern'], 2)."€<br>Preis extern: ".number_format($meal['price_extern'], 2)."€<br><br>Allergien: <ul>\n";}
            foreach ($meal['allergens'] as $allergen) {
                echo "<li>".$allergens[$allergen]. " </li>";
            }
            echo "</ul>\n";
        }
        if(isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] == 'en')
        {
            echo "<h1>Ratings (In total:". calcMeanStars($ratings). ")</h1>";
        } else {echo "<h1>Bewertungen (Insgesamt:". calcMeanStars($ratings). ")</h1>";}
        ?>
        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" <?php if(isset($_GET[GET_PARAM_SEARCH_TEXT])) {echo "placeholder=". $_GET[GET_PARAM_SEARCH_TEXT];}?>>
            <input type="submit" value="<?php
            if(isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] == 'en')
            {
                echo "Search";
            } else {echo "Suchen";}
            ?>">
        </form>
        <table class="rating">
            <thead>
            <tr>
                <?php
                if(isset($_GET[GET_PARAM_SPRACHE]) && $_GET[GET_PARAM_SPRACHE] == 'en')
                {
                    echo "<td>Text</td>
                    <td>Author</td>
                    <td>Stars</td>";
                } else
                {
                    echo "<td>Text</td>
                    <td>Autor</td>
                    <td>Sterne</td>";
                }
                ?>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($showRatings as $rating) {
                echo "<tr><td class='rating_text'>{$rating['text']}</td>
                              <td class='rating_text'> {$rating['author']} </td>
                              <td class='rating_stars'>{$rating['stars']}</td>
                          </tr>";
            }
            ?>
            </tbody>
        </table>

        <br>
        <a href="meal.php?sprache=de">Deutsch</a> ||
        <a href="meal.php?sprache=en">English</a>

    </body>
</html>
