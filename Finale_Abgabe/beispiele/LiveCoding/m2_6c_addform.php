<?php
include "m2_6a_standardparameter.php";
const GET_PARAM_A = 'a';
const GET_PARAM_B = 'b';

?>
<!DOCTYPE html>
<html lang="de">
<form method="get" action="">
    <label for="a">a:</label>
    <input id="a" type="number" name="a" required>
    <label for="b">b:</label>
    <input id="b" type="number" name="b" required>
    <label for="multi"> Rechenart: </label>
    <input id="equals" type="submit" name="add" value="add">
    <input id="multi" type="submit" name="multi" value="multi">
</form>
<?php
if(isset($_GET[GET_PARAM_A]) && isset($_GET[GET_PARAM_B]))
{
    if(isset($_GET['multi']))
    {
        echo multi($_GET[GET_PARAM_A], $_GET[GET_PARAM_B]);
    }
    if(isset($_GET['add']))
    {
        echo add($_GET[GET_PARAM_A], $_GET[GET_PARAM_B]);
    }
}
?>
</html>

