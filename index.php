<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Bar PHP</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
$progress = 0;
$emptyQuantity = false;
$emptyGoal = false;
$overLoad = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantity = $_POST['quantity'];
    $goal = $_POST['goal'];
    $emptyQuantity = empty($quantity);
    $emptyGoal = empty($goal);
    if (!$emptyQuantity && !$emptyGoal) {
        $overLoad = $quantity > $goal;
        if(!$overLoad)
            $progress = round($quantity/$goal * 100);
    }
}
?>

<body>
    <div class="main">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <div class="label">
                <label for="quantity">Quantity:</label>
            </div>
            <input type="number" id="quantity" name="quantity" min="0"
                class="<?php if($emptyQuantity || $overLoad) echo "error"; ?>" value="<?php echo $quantity; ?>">
            <?php if($emptyQuantity) { ?>
            <span class="errorLabel">Please enter a Quantity.</span>
            <?php } ?>
            
            <div class="label">
                <label for="goal">Goal:</label>
            </div>
            <input type="number" id="goal" name="goal" min="0"
                class="<?php if($emptyGoal || $overLoad) echo "error"; ?>" value="<?php echo $goal; ?>">
            <?php if($emptyGoal) { ?>
            <span class="errorLabel">Please enter a Goal.</span>
            <?php } ?>

            <?php if($overLoad) { ?>
            <span class="errorLabel">Quantity can't be higher than Goal.</span>
            <?php } ?>

            <input type="submit" name="submit">
        </form>

        <label for="progress">Progress:</label>
        <div id="progress" style="width:<?php if($progress > 0) echo $progress; ?>%" max="100" min="0"> <?php echo $progress; ?>% </div>
    </div>
</body>

</html>