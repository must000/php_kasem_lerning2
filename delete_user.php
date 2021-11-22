<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $link = mysqli_connect("localhost", "mmmm", "", "myshop")
        or die("Connest Failed! -> " . mysqli_error($link));
    mysqli_query($link, "SET NAMES UTF8" or die(mysqli_error($link)));
    $sql = "SELECT profile FROM account WHERE user_id='" . $_GET['user_id'] . "' LIMIT 1";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    $profile_img = mysqli_fetch_assoc($result);
    @unlink("profile_img/" . $profile_img['profile']);

    $sql = "DELETE FROM account WHERE user_id='" . $_GET['user_id'] . "' LIMIT 1";
    if (mysqli_query($link, $sql)) {
        print "ลบผู้ใช้สำเร็จแล้ว <br>
            <a href='backOffice.php?page=user'>กลับไป</a>";
    } else {
        print "ลบผู้ใช้ไม่สำเร็จ --> " . mysqli_error($link);
    }
    ?>

</body>

</html>