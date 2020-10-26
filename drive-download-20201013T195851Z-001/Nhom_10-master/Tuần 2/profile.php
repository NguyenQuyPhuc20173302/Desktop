<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="profile.css">
    <title>Thông tin đã nhập</title>
</head>

<body>
    <div class="box">
        <div class="header">
            <?php
            if (!isset($_POST['sendData'])) return;
            if (isset($_FILES['avatar'])) {
                $targetDir = "./image/" . $_FILES['avatar']['name'];
                move_uploaded_file($_FILES['avatar']['tmp_name'], $targetDir);
            }
            ?>
            <img class="avatar" src="<?php echo $targetDir ?>">
            <div class="infomation-header">
                <h3 class="fullname"><?php echo ($_POST['name']) ?></h3>
                <p><?php echo ($_POST['gender'] == "1" ? "Man" : "Woman") ?></p>
                <p><?php echo date_format(date_create($_POST['birthday']), "d/m/Y") ?></p>
                </p>
            </div>
        </div>
        <div class="content">
            <div class="overview">
                <h3 class="line-bottom">Overview</h3>
                <p><?php echo $_POST['overview'] ?> ?></p>
            </div>
            <div class="main-information">
                <h3>Main information</h3>
                <p>Class: <?php echo $_POST['class'] ?></p>
                <p>University: <?php echo $_POST['university'] ?></p>
                <p>Adrress: <?php echo $_POST['address'] ?></p>
            </div>
            <div class="favorite">
                <h3>Favorite</h3>
                <?php
                $num = 1;
                if (isset($_POST['hobbies'])) {
                    if (is_object($_POST['hobbies'])) {
                        foreach ($_POST['hobbies'] as $hobby) {
                            echo "&nbsp;&nbsp;$num. $hobby<br>";
                            $num++;
                        }
                    }
                }
                ?>
            </div>
            <div class="career">
                <h3>Career</h3>
                <?php echo "{$_POST['career']}"; ?>
            </div>
        </div>
    </div>
</body>

</html>
