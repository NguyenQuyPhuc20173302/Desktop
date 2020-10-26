<html>

<head>
    <title>
        Time Processing
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        .row {
            display: flex;
            flex-wrap: nowrap;
            margin-left: 0px;
            margin-right: 0px;
        }
    </style>
</head>

<body style="background-image: url(sunflower.jpg); background-size: cover;">
    <div class="row" style="margin-top: 50px;">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border: 4px solid #007bff; border-radius: 20px; background: rgba(255, 255, 255, 0.5);">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <h4 style="text-align: center; margin: 20px auto;">Time Processing</h4>
                <?php
                $now = date("Y");
                if (array_key_exists("yourName", $_POST)) {
                    $yourName = $_POST["yourName"];
                    $date = $_POST["date"];
                    $month = $_POST["month"];
                    $year = $_POST["year"];
                    $hour = $_POST["hour"];
                    $minute = $_POST["minute"];
                    $second = $_POST["second"];
                } else {
                    //mặc định
                    $yourName = "";
                    $date = 1;
                    $month = 1;
                    $year = 2000;
                    $hour = 0;
                    $minute = 0;
                    $second = 0;
                }
                ?>
                <label>Your Name:</label>
                <input type="text" class="form-control" name="yourName" value="<?php print "$yourName" ?>">
                <label>Date:</label>
                <div class="row">
                    <select name="date" class="custom-select">
                        <?php
                        for ($i = 1; $i <= 31; $i++) {
                            if ($date == $i) {
                                print("<option selected>$i</option>");
                            } else {
                                print("<option>$i</option>");
                            }
                        }
                        ?>
                    </select>
                    <select name="month" class="custom-select">
                        <?php
                        for ($i = 1; $i <= 12; $i++) {
                            if ($month == $i) {
                                print("<option selected>$i</option>");
                            } else {
                                print("<option>$i</option>");
                            }
                        }
                        ?>
                    </select>
                    <select name="year" class="custom-select">
                        <?php
                        for ($i = 1200; $i <= (int)$now; $i++) {
                            if ($month == $i) {
                                print("<option selected>$i</option>");
                            } else {
                                print("<option>$i</option>");
                            }
                        }
                        ?>
                    </select>
                </div>
                <label>Time:</label>
                <div class="row">
                    <select name="hour" class="custom-select">
                        <?php
                        for ($i = 0; $i < 24; $i++) {
                            if ($hour == $i) {
                                print("<option selected>$i</option>");
                            } else {
                                print("<option>$i</option>");
                            }
                        }
                        ?>
                    </select>
                    <select name="minute" class="custom-select">
                        <?php
                        for ($i = 0; $i < 60; $i++) {
                            if ($minute == $i) {
                                print("<option selected>$i</option>");
                            } else {
                                print("<option>$i</option>");
                            }
                        }
                        ?>
                    </select>
                    <select name="second" class="custom-select">
                        <?php
                        for ($i = 0; $i < 60; $i++) {
                            if ($second == $i) {
                                print("<option selected>$i</option>");
                            } else {
                                print("<option>$i</option>");
                            }
                        }
                        ?>
                    </select>
                </div>
                <div style="width: 100%; text-align: center;">
                    <button type="submit" class="btn btn-primary" style="width: 150px; margin-top: 50px;">Submit</button>
                    <button type="reset" class="btn btn-primary" style="width: 150px; margin-top: 50px;">Reset</button>
                </div>
                <?php
                $isDate = checkdate($month, $date, $year);
                if ($isDate) {
                    if (!empty($yourName)) {
                        print "<br></br>";
                        print "<b>Hi $yourName! <br></br>";
                        print "You choose to have an appointment on: " . sprintf("%02d:%02d:%02d, %02d/%02d/%d. <br><br>", $hour, $minute, $second, $date, $month, $year);
                        print "More information: <br></br>";
                        print "In 12 hours, the time and date is: ";
                        //Chuyển đổi AM, PM
                        if ($hour > 12) {
                            $hour -= 12;
                            print sprintf("%02d:%02d:%02d PM, %02d/%02d/%d. <br><br>", $hour, $minute, $second, $date, $month, $year);
                        } else {
                            print sprintf("%02d:%02d:%02d AM, %02d/%02d/%d. <br><br>", $hour, $minute, $second, $date, $month, $year);
                        }
                        print "This month has: ";
                        switch ($month) {
                            case 1:
                            case 3:
                            case 5;
                            case 7:
                            case 8:
                            case 10:
                            case 12:
                                print "31 days.<br></br>";
                                break; // Những tháng có 31 ngày
                            case 4:
                            case 6:
                            case 9:
                            case 11:
                                print "30 days.<br></br>"; // Tháng có 30 ngày
                            case 2:
                                //Kiểm tra năm nhuận
                                if ($year % 4 == 0) {
                                    if (($year % 100 != 0) || (($year % 100 == 0) && ($year % 400 == 0))) {
                                        print "29 days!. <br></br>"; // Năm nhuận tháng 2 có 29 ngày
                                    }
                                } else {
                                    print "28 days!. <br></br></b>"; // Năm không nhuận tháng 2 có 28 ngày
                                }
                        }
                    } else {
                        echo "Please enter your name!";
                    }
                } else  echo "Incorrect date format!";
                ?>
            </form>
        </div>
    </div>
</body>

</html>