<?php
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => [2019]]];
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Essen</title>
    <style>
        li{
            margin: 5px;
        }
    </style>
</head>
<ol>

    <?php
    $years = [];
    foreach ($famousMeals as $meal)
    {
        echo '<li>' . $meal['name'].'<br>';
        foreach(array_reverse($meal["winner"]) as $year)
        {
            $years[] = $year;
            if($year != $meal['winner'] [0])
            {
                echo $year;
                echo ", ";
            }
            else {echo $year;}
        }
        echo '</li>';
    }
    echo "Jahr ohne Gewinner: ";
    for($jahr = 2000; $jahr <= 2024; $jahr++)
    {
        $bool = false;
        foreach($years as $year)
        {
            if($year == $jahr)
            {$bool = true; break;}
        }
        if(!$bool)
        {echo $jahr. "  ";}
    }

    ?>
</ol>
</html>
