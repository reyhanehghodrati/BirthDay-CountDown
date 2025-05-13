<!DOCTYPE html>
<html lang="en">
<?php
$title="خانه";
$css="css/Home.css";
?>

<?php
include 'php/head.php';
?>
<body dir="rtl">
<header>
    <h1>زادروز تیم آرنا ویژن</h1>
</header>
<section class="birthdays">

    <?php if (!empty($birthday_list) && $birthday_list->num_rows>0):?>
        <?php foreach ($birthday_list as $item): ?>
            <?php
            $timestamp = strtotime($item['birthday']);
            $shamsi = jdate('Y/m/d', $timestamp);
            ?>
            <div class="card">
                <h3><?= htmlspecialchars($item['name']) ?></h3>
                <p><?= $shamsi ?> (<?= $item['days_left'] ?> روز مانده)</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="countdown-box">
            <h2>هیچ تولدی در ۳۰ روز آینده نیست!</h2>
            <div class="quote">"لحظه‌ها را زندگی کن..."</div>
        </div>
    <?php endif; ?>
</section>

</body>
</html>
