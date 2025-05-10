<?php
$request =parse_url( $_SERVER['REQUEST_URI']);
require_once 'controller/Login_controller.php';
require_once 'controller/Birthday_insert_controller.php';
require_once 'controller/Birthday_get_controller.php';

require_once 'model/Login.php';
require_once 'model/Birthday.php';
require_once 'model/SendSms.php';
$viewDir = '/view/';


switch ($request['path']) {
    case '/BirthDay-CountDown/view/home':
        $controller=new Birthday_get_controller();
        $controller->show_result();
        break;
    case '/BirthDay-CountDown/view/login':
        $controller=new Login_controller();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $controller->login_check();
        }else{
            $controller->showForm();
        }
        break;
    case '/BirthDay-CountDown/view/Admin-dashboard':
        if(!isset($_SESSION['username'])){
            header("Location:/BirthDay-CountDown/view/login");
            exit;
        }else{
            $controller=new Birthday_insert_controller();

            if(isset($_POST['name'] , $_POST['mobile'] ,$_POST['birthday'],$_POST['about'])) {
                $controller->set_result();
            }
            $controller->show_result();
            break;
        }

    case '/BirthDay-CountDown/view/Admin-send':
        $controller = new Birthday_get_controller();
        $controller->sendSMS();
        break;


    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}




