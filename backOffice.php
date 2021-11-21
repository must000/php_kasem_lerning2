session_start();
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table border="1" width="100%">
        <tr>
            <td width="200">
                <h2>Menu</h2>
                <ul>
                    <li><a href="backOffice.php?page=user">จัดการผู้ใช้</a></li>
                    <li><a href="backOffice.php?page=category">จัดการหมวดสินค้า</li>
                    <li><a href="backOffice.php?page=product">จัดการสินค้า</li>
                </ul>
            </td>
            <td>
                <?php
                $link = mysqli_connect("localhost", "mmmm", "", "myshop")
                    or die("Connest Failed! -> " . mysqli_error($link));
                mysqli_query($link, "SET NAMES UTF8" or die(mysqli_error($link)));
                if ($_GET['page'] == 'user') {
                    $sql = "SELECT * FROM account ORDER BY role";
                    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
                ?>
                    <table width="100%" border="1">
                        <thead>
                            <tr>
                                <th>ชื่อ - นามสกุล</th>
                                <th>รูปโปรไฟล์</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?= $row['pre'] . $row['fullname'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['profile'] != "") {
                                        ?>

                                            <img src="profile_img/<?= $row['profile'] ?>" width="100px" alt="" srcset="">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['role'] ?></td>
                                    <td><a href="edit_profile.php?user_id=<?= $row['user_id'] ?>">แก้ไข</a></td>
                                    &nbsp;&nbsp;
                                    <td><a href="delete_user.php?user_id=<?= $row['user_id'] ?>" onclick="confirm('ลบผู้ใช้คนนี้ แน่ใจหรือไม่?');">ลบ</a></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>

                <?php
                } elseif ($_GET['page'] == 'category') {
                } elseif ($_GET['page'] == 'product') {
                }

                ?>
            </td>
        </tr>
    </table>
</body>

</html>