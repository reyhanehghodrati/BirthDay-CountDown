<?php
//require_once('../vendor/autoload.php');
//
//try {
//
//    $sender = "2000660110";
//    $receptor = "09109253995";
//    $message = "وب سرویس پیام کوتاه کاوه نگار";
//    $api = new \Kavenegar\KavenegarApi("723454473278747443444E65453776625A6A706A59773167416E3768724F4336");
//    $api -> Send ($sender,$receptor,$message);
//    $result = $api->Send(null, $receptor, $message);
//    if ($result) {
//        foreach ($result as $r) {
//            echo "پیام با موفقیت ارسال شد به {$r->receptor}، وضعیت: {$r->statusText}\n";
//        }
//    }
//} catch(\Kavenegar\Exceptions\ApiException $e){
//    echo "خطای API: " . $e->errorMessage();
//} catch(\Kavenegar\Exceptions\HttpException $e){
//    echo "خطای HTTP: " . $e->errorMessage();
//}
//?>


<?php
require_once '../php/jdf.php';
function shamsi_to_miladi($date) {
// Separate the Shamsi date components
list($year, $month, $day) = explode('/', $date);

// Convert Shamsi date to Miladi
list($gy, $gm, $gd) = jalali_to_gregorian((int)$year, (int)$month, (int)$day);

return sprintf('%04d-%02d-%02d', $gy, $gm, $gd);

}
echo shamsi_to_miladi('1385/05/25');
?>