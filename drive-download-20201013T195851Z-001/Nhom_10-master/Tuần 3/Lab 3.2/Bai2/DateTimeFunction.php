<?php
// check
function validateBirthday($birthday)
{
    $temp = explode('-', $birthday); // tách chuỗi, trả về mảng day, month, year
    if (count($temp) != 3) return false; // kiểm tra xem đủ 3 thành phần d,m,y
    return checkdate($temp[1], $temp[2], $temp[0]); //kiểm tra có hợp lệ là ngày không
}
//Tính người 1 sinh trc người 2 bao nhiêu ngày, có lấy số âm
function dateDiff($birthday1, $birthday2)
{
    return (int) date_diff($birthday1, $birthday2)->format("%R%a");
}
// Lấy tuổi
function calcAge($birthday)
{
    $now = date_create(); // lấy năm hiện tại
    return date_diff($now, $birthday)->y;
} 
//format ngày theo  thứ, tháng ngày,năm
function dateInLetter($date)
{
    return date_format($date, "l, F d, Y");
}
// Cờ kiểm tra tên đã nhập chưa (fase chưa, true có)
$flag = true;

if (!isset($_POST["name1"])) {
    $name1 = "";
    $flag = false;
} else {
    $name1 = $_POST["name1"];
}

if (!isset($_POST["name2"])) {
    $flag = false;
    $name2 = "";
} else {
    $name2 = $_POST["name2"];
}

if (!isset($_POST["birthday1"])) {
    $temp_birthday1 = "";
    $flag = false;
} else {
    $temp_birthday1 = $_POST["birthday1"];
}

if (!isset($_POST["birthday2"])) {
    $temp_birthday2 = "";
    $flag = false;
} else {
    $temp_birthday2 = $_POST["birthday2"];
}
// Nếu đã nhập đầy đủ tên và kiểm tra ngày sinh hợp lệ
if ($flag || validateBirthday($temp_birthday1)) {
    $birthday1 = date_create($temp_birthday1);
} else {
    $flag = false;
}

if ($flag || validateBirthday($temp_birthday2)) {
    $birthday2 = date_create($temp_birthday2);
} else {
    $flag = false;
}
// Chuẩn bị các biến để hiện thị thông tin khi thông tin đã đủ
if ($flag) {
    $diffday = dateDiff($birthday1, $birthday2);
    $diffyear = calcAge($birthday1) - calcAge($birthday2);
}
// lấy thời gian hiện tại
$currentDay =date("Y-m-d");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>DateTimeFunction</title>
</head>

<body style="background-image: url(sunflower.jpg); background-size: cover;">
    <div class="content" style="border: 5px solid #007bff; border-radius: 20px; margin-top: 70px; background-color: rgba(255,255,255,0.4)">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="container">
                <div class="info">
                    <div class="title">
                        Người thứ nhất
                    </div>
                    <div class="name">
                        <label>Họ và tên:</label>
                        <input class="name" type="text" name="name1" placeholder="Họ và tên người thứ nhất" value="<?php echo $name1; ?>" required>
                    </div>
                    <div class="birthday">
                        <label>Ngày sinh:</label>
                        <input class="date" type="date" name="birthday1" max="<?php echo $currentDay?>" value="<?php echo $temp_birthday1; ?>" required>
                    </div>
                </div>
                <div class="info">
                    <div class="title">
                        Người thứ hai
                    </div>
                    <div class="name">
                        <label>Họ và tên:</label>
                        <input class="name" type="text" name="name2" placeholder="Họ và tên người thứ hai" value="<?php echo $name2; ?>" required>
                    </div>
                    <div class="birthday">
                        <label>Ngày sinh:</label>
                        <input class="date" type="date" name="birthday2" max="<?php echo $currentDay?>"  value="<?php echo $temp_birthday2; ?>" required>
                    </div>
                </div>
            </div>
            <div class="submit">
                <input class="submit" type="submit" value="Submit" style="width: 250px;">
            </div>
            <?php if ($flag) { ?>
                <div class="container">
                    <div class="info">
                        <div class="name">
                            <label>Họ và tên:</label>
                            <span>
                                <?php
                                echo $name1;
                                ?>
                            </span>
                        </div>
                        <div class="birthday">
                            <label>Ngày sinh:</label>
                            <span>
                                <?php
                                echo dateInLetter($birthday1);
                                ?>
                            </span>
                        </div>
                        <div class="age">
                            <label>Tuổi:</label>
                            <span>
                                <?php
                                echo calcAge($birthday1);
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="info">
                        <div class="name">
                            <label>Họ và tên:</label>
                            <span>
                                <?php
                                echo $name2;
                                ?>
                            </span>
                        </div>
                        <div class="birthday">
                            <label>Ngày sinh:</label>
                            <span>
                                <?php
                                echo dateInLetter($birthday2);
                                ?>
                            </span>
                        </div>
                        <div class="age">
                            <label>Tuổi:</label>
                            <span>
                                <?php
                                echo calcAge($birthday2);
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="notification">
                    <?php
                    echo $name1;
                    if ($diffday == 0) {
                        echo " và " . $name2 . " sinh cùng ngày.";
                    } else
                if ($diffday > 0) {
                        echo " sinh trước " . $name2 . " " . $diffday . " ngày.";
                    } else {
                        echo " sinh sau " . $name2 . " " . -$diffday . " ngày.";
                    }
                    ?>
                </div>
                <div class="notification">
                    <?php
                    echo $name1;
                    if ($diffyear == 0) {
                        echo " và " . $name2 . " bằng tuổi nhau.";
                    } else
                if ($diffyear > 0) {
                        echo " hơn " . $name2 . " " . $diffyear . " tuổi.";
                    } else {
                        echo " kém " . $name2 . " " . -$diffyear . " tuổi.";
                    }
                    ?>
                </div>
            <?php } ?>
        </form>
    </div>
</body>

</html>