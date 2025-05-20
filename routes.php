<?php
$request =parse_url( $_SERVER['REQUEST_URI']);
require_once 'config.php';
require_once ROOT.'controller/Login_controller.php';
require_once ROOT.'controller/Birthday_insert_controller.php';
require_once ROOT.'controller/Birthday_get_controller.php';

require_once ROOT.'model/Login.php';
require_once ROOT.'model/Birthday.php';
require_once ROOT.'model/SendSms.php';
$viewDir = '/view/';


switch ($request['path']) {
    case  '/':
        $controller=new Birthday_get_controller();
        $controller->show_result();
        break;
    case '/login':
        $controller=new Login_controller();
        if(isset($_SESSION['username'])){
            header("Location:/Admin-dashboard");
            exit;}
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $controller->login_check();
        }else{
            $controller->showForm();
        }
        break;
    case '/Admin-dashboard':
        if(!isset($_SESSION['username'])){
            header("Location:/login");
            exit;
        }else{
            $controller=new Birthday_insert_controller();

            if(isset($_POST['name'] , $_POST['mobile'] ,$_POST['birthday'],$_POST['about'])) {
                $controller->set_result();
            }
            $controller->show_result();
            break;
        }

    case '/Admin-send':
        $controller = new Birthday_get_controller();
        $result=$controller->sendSMS();
        if($result){

        }
        break;

    case '/deleteUser':
        $del=new Birthday_get_controller();
        $del->deleteUser();
        break;
    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}




