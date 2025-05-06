<?php
$request =parse_url( $_SERVER['REQUEST_URI']);
require_once 'controller/Form_controllers.php';
require_once 'model/Contact.php';
$viewDir = '/view/';


switch ($request['path']) {
    case '':
    case '/':
        require __DIR__ . $viewDir . 'home.php';
        break;

    case '/laravel-prj/view/login':
        require (__DIR__ . $viewDir . 'login.php');
        break;

    case '/laravel-prj/view/reserv':
        $controller=new formControllers();
         if($_SERVER['REQUEST_METHOD']==='POST'){
             $controller->saveForm();
         }else{
             $controller->showForm();
         }
//         $controller->showForm();
        break;
    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}

//Route::get('/view/login',function(){
//    return "test tenis" ;
//});
?>


