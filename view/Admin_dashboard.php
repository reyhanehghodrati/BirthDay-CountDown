<?php
if (!isset($_SESSION['username'])) {
    header("Location: /BirthDay-CountDown/view/login");
    exit();
}

require_once 'controller/Birthday_insert_controller.php';

?>

<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>داشبورد ادمین</title>
    <link rel="stylesheet" href="../css/Admin_dashboard.css">
</head>
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
        <input type="text" name="birthday" id="name" required placeholder="1380/01/01">


        <label for="about">توضیحات:</label>
        <textarea name="about" id="about" rows="4" ></textarea>

        <input type="submit" value="اضافه کردن تولد">
    </form>
    <a href="/BirthDay-CountDown/view/home" >خانه</a>
</div>

<div class="table-container">
    <h2>لیست تولدها</h2>
    <table>
        <tr>
            <th>نام</th>
            <th>موبایل</th>
            <th>تولد</th>
            <th>توضیحات</th>
        </tr>
        <?php

        while ($row =$result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['mobile']) ?></td>
                <td><?= htmlspecialchars($row['birthday']) ?></td>
                <td><?= htmlspecialchars($row['about']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>