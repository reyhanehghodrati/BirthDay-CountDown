<?php
if (!isset($_SESSION['username'])) {
    header("Location: /login");
    exit();
}
$_SESSION["token"] = bin2hex(random_bytes(32));
// expiration token:
$_SESSION["token-expire"] = time() + 3600;
$old_values=$_SESSION['old_values'] ?? [];
require_once ROOT.'controller/Birthday_insert_controller.php';
require_once ROOT.'controller/Sms_setting.php';
?>
<!DOCTYPE html>
<html lang="fa">
<?php
$title="داشبورد ادمین";
$css="css/Admin_dashboard.css";

include 'php/head.php';
//include 'php/datapicker.php';
?>
<body dir="rtl">

<h1>پنل مدیریت تولدها</h1>

<div class="form-container">
    <?php
    if (isset($_SESSION['message'])):
        ?>
        <p style="color: red"><?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?></p>
    <?php
    endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">نام:</label>
        <input type="text" name="name" id="name" required>

        <label for="name">شماره تماس :</label>
        </br>
        <input type="number" name="mobile" id="name" required>
        </br>
        </br>
        <label for="name">تولد:</label>
        <input type="text" name="birthday" class="date_picker" id="name" required placeholder="1380/01/01">

<!--        <label>کد امنیتی:</label>-->
<!--        <img src="../php/captcha.php" alt="captcha code">-->
<!--        <input type="text" name="captcha_input" placeholder="کد را وارد کنید " >-->

        <label for="about">توضیحات:</label>
        <textarea name="about" id="about" rows="4" ></textarea>
<!--        <input type="hidden" name="token" value="--><?//= $_SESSION["token"] ?><!--"/>-->
        <input type="submit" value="اضافه کردن تولد">
    </form>
    <a href="/" >خانه</a>
</div>

<div class="table-container">
    <h2>لیست تولدها</h2>
    <table>
        <tr>
            <th>نام</th>
            <th>موبایل</th>
            <th>تولد</th>
            <th>توضیحات</th>
            <th>عملیات</th>
        </tr>
        <?php

        while ($row =$result->fetch_assoc()):
            $date=strtotime($row['birthday'])?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['mobile']) ?></td>
                <td><?= htmlspecialchars( jdate('Y/m/d',$date )) ?></td>
                <td><?= htmlspecialchars($row['about']) ?></td>
                <td>
                    <form action="/deleteUser" method="post" onsubmit="return confirm('آیا مطمئن هستید؟')">
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <button type="submit">حذف</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
<div  class="table-container">
    <h2>تنظیمات</h2>
    <table>
        <tr>
            <th>روز باقی مانده تا تولد</th>
            <th>شماره تماس ادمین</th>
        </tr>
        <tr>
            <?php
            while ($row =$setting_r->fetch_assoc()): ?>
            <td>
                <form action="/update_notifday" method="post" onsubmit="return confirm('آیا مطمئن هستید؟')">
                    <input type="number" name="notif_day" value="<?= htmlspecialchars($row['notif_day']) ?>">
                    <button type="submit">ثبت</button>
                </form>
            </td>
            <td>
                <form action="/update_phone" method="post" onsubmit="return confirm('آیا مطمئن هستید؟')">
                <input type="number" name="admin-num" value="<?= htmlspecialchars($row['admin_phone']) ?>">
                <button type="submit">ثبت</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
        </table>
</div>
<script>
$('.date_picker').persianDatepicker({
    observer: true,
    format: 'YYYY/MM/DD',
    altField: '.observer-example-alt'
});
</script>
</body>
</html>