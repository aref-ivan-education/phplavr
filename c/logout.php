<?  include_once('../models/auth.php');
    include_once('../models/check.php');
    include_once('../models/users.php');



    if(!isset($_SESSION)){
        session_start();
    }
    $logOut=logOut();

    $urlrefer= $_SERVER['HTTP_REFERER']??"/";
    header('Location:'.$urlrefer);
    exit();
    