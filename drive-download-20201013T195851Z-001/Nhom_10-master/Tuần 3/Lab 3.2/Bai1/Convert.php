<?php
//Chuyển từ rad sang độ
function radToDeg($rad)
{
    return 180 * $rad / pi();
}
// Chuyển từ độ sang rad
function degToRad($deg)
{
    return $deg * pi() / 180;
}
$mode = 0; // mode=1 is rad to deg and mode =2 vice versa
if (isset($_POST["rad"])) {
    $mode = 1;
}
if (isset($_POST["deg"])) {
    $mode = 2;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Convert radians to degrees and vice versa</title>
</head>

<body style="background-image: url(sunflower.jpg); background-size: cover;">
    <div class="content" style="display: flex; margin-top: 100px; width: 1000px;">
        <div class="container">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div>
                    <label>Radians </label>
                    <input type="text" name="rad" value="<?php if ($mode == 1) echo $_POST["rad"];
                                                            if ($mode == 2) echo degToRad($_POST["deg"]); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                </div>
                <div class="submit">
                    <input class="submit" type="submit" value="Convert">
                </div>
            </form>
        </div>
        <div class="container">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <div>
                    <label>Degrees</label>
                    <input type="text" name="deg" value="<?php if ($mode == 2) echo $_POST["deg"];
                                                            if ($mode == 1) echo radToDeg($_POST["rad"]); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
                </div>
                <div class="submit">
                    <input class="submit" type="submit" value="Convert">
                </div>
            </form>
        </div>

    </div>
</body>

</html>