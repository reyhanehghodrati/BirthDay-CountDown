<!DOCTYPE html>
<html lang="en">
<?php
$title="ورود";
$css="css/login.css";
include 'php/head.php';
?>
<body>
<div class="wrapper">
    <!-- فرم ورود -->
    <div class="form-container sign-in">
        <form action="" method="POST">
            <h2>ورود</h2>
            <div class="form-group">
                <input type="text" name="username" required>
                <i class="fas fa-user"></i>
                <label for="">نام کاربری</label>
            </div>
            <div class="form-group">
                <input type="password" name="password" required>
                <i class="fas fa-lock"></i>
                <label for="">گذرواژه</label>
            </div>
            <div class="forgot-pass" dir="rtl">
                <a href="#">گذرواژه خود را فراموش کردید؟</a>
            </div>
            <button type="submit" class="btn">ورود</button>
            <div class="link">
                <p>آیا حساب کاربری دارید؟<a href="#" class="signup-link"> ثبت نام</a></p>
            </div>
        </form>


    </div>
</div>
<?php

if (isset($_SESSION['message'])):
    ?>
    <p style="color: red"><?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?></p>
<?php
endif; ?>

</body>

</html>
