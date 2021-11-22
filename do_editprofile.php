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

    $sql = "UPDATE account SET 
        pre='" . $_POST['pre'] . "',
        fullname ='" . $_POST['fullname'] . "',
        address ='" . $_POST['address'] . "',
        have_credit ='" . @$_POST['have_credit'] . "',
        interest ='" . implode(',', $_POST['interest']) . "'
        WHERE user_id='" . $_POST['user_id'] . "' LIMIT 1";
    if (mysqli_query($link, $sql)) {
        //อัพเดตสำเร็จ

        //อัพเดตรูปโปรไฟล์
        if (isset($_FILES)) {
            $sql = "SELECT profile FROM account WHERE user_id='" . $_POST['user_id'] . "' LIMIT 1";
            $result = mysqli_query($link, $sql);
            $profile_img = mysqli_fetch_assoc($result);
            @unlink("profile_img/" . $profile_img['profile']);
            if (move_uploaded_file($_FILES["profile"]["tmp_name"], "profile_img/" . $_FILES["profile"]["name"])) {
                $sql = "UPDATE account SET
                profile = '" . $_FILES["profile"]["name"] . "'
                WHERE user_id = '" .  $_POST['user_id'] . "'LIMIT 1";
                mysqli_query($link, $sql) or die("Update Failed!->" . mysqli_error($link));

                //อัพเดตรหัสผ่าน
                if ($_POST['password1'] != '') {
                    if ($_POST['password1'] != $_POST['password2']) {
                        print "<h2> มึงใส่ไม่เหมือนกัน";
                    } else {
                        $sql = "UPDATE account SET password='" . $_POST['password1'] . "'
                        WHERE user_id='" . $_POST['user_id'] . "' LIMIT 1";
                        if (mysqli_query($link, $sql)) {
                        } else {
                            print "Update รหัสผ่านไม่สำเร็จ!!!";
                            exit();
                        }
                    }
                }
            } else {
                print "อัพเดตรูปโปรไฟล์ไม่สำเร็จ!!!";
                exit();
            }
        }
        print "<h2>อัพเดตุสำเร็จแล้ว<h2/>
        <a href='backOffice.php?page=user'>กลับไปหน้าจัดการ</a>";
    } else {
        print "UPDATE Failed!!!" . mysqli_error($link);
    }
    ?>
</body>

</html>