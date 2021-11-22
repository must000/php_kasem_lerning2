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
    $sql = "SELECT * FROM account WHERE user_id='" . $_GET['user_id'] . "' LIMIT 1";
    $result = mysqli_query($link, $sql) or die(mysqli_error($link));
    if (mysqli_num_rows($result) == 0) {
        print "ไม่พบ User ที่เลือก";
        exit();
    }
    $info = mysqli_fetch_assoc($result)
    ?>


    <h3>แก้ไขข้อมูลสมาชิก</h3>
    <form action="do_editprofile.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="user_id" value="<?= $_GET['user_id'] ?>">

        <h4>
            ข้อมูลส่วนบุคคล
        </h4>
        <div class="gorm-group">
            <label for="pre">คำนำหน้า</label>
            <select name="pre" id="pre">
                <option value="นาย" <?php
                                    if ($info['pre'] == 'นาย') {
                                        print 'selected';
                                    }
                                    ?>>นาย</option>
                <option value="นาง" <?php
                                    if ($info['pre'] == 'นาง') {
                                        print 'selected';
                                    }
                                    ?>>นาง</option>
                <option value="นางสาว" <?= ($info['pre'] == 'นางสาว') ? 'selected' : '' ?>>นางสาว</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fullname">ชื่อ-นามสกุล</label>
            <input type="text" name="fullname" id="fullname" required value="<?= $info['fullname'] ?>">
        </div>
        <div class="form-group">
            <label for="address">ที่อยู่</label>
            <textarea name="address" id="address" cols="30" rows="3"> <?= $info['address'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="have_credit">มีบัตรเครดิตหรือไม่</label>
            <input type="radio" name="have_credit" id="have_credit" value="yes" <?php
                                                                                if ($info['have_credit'] == 'yes') {
                                                                                    print 'checked';
                                                                                }
                                                                                ?>>มี
            <input type="radio" name="have_credit" id="no_credit" value="no" <?php ($info['have_credit'] == 'yes') ? 'checked' : '' ?>>ไม่มี
        </div>
        <div class="form-group">
            <label for="interest">สินค้าที่สนใจ</label>
            <?php
            $arr = explode(',', $info['interest'])
            ?>
            <input type="checkbox" name="interest[]" id="cloth" value="cloth" <?php
                                                                                if (in_array('cloth', $arr)) {
                                                                                    print 'checked';
                                                                                }
                                                                                ?>> เสื้อผ้า
            <input type="checkbox" name="interest[]" id="bag" value="bag" <?php
                                                                            if (in_array('bag', $arr)) {
                                                                                print 'checked';
                                                                            }
                                                                            ?>> กระเป๋า
            <input type="checkbox" name="interest[]" id="shoe" value="shoe" <?php
                                                                            if (in_array('shoe', $arr)) {
                                                                                print 'checked';
                                                                            }
                                                                            ?>> รองเท้า
        </div>
        <div class="form-group">
            <label for="profile">รูปโปรไฟล์</label>
            <?php
            if ($info['profile'] != '') {
            ?>
                <img src="profile_img/<?= $info['profile'] ?>" width="100" alt="">
            <?php
            }
            ?>
            <br>
            อัพโหลดรูปใหม่
            <input type="file" name="profile" id="profile">
        </div>
        <h3>ข้อมูลการเข้าสู่ระบบ</h3>
        <div class="form-group">
            <label>Username : <?= $info['username'] ?></label>

        </div>
        <div class="form-group">
            <label>พิมพ์รหัสผ่านใหม่</label>
            <input type="text" name="password1" id="password1">
        </div>
        <div class="form-group">
            <label>พิมพ์อีกครั้ง</label>
            <input type="text" name="password2" id="password2">
        </div>
        <button type="submit"><strong> บันทึก</strong></button>
    </form>
</body>

</html>