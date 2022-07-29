<?  include_once('../m/auth.php');
    include_once('../m/check.php');
    include_once('../m/users.php');



    if(!isset($_SESSION)){
        session_start();
    }
    $logOut=logOut();

    $urlrefer= $_SERVER['HTTP_REFERER']??"/";
    header('Location:'.$urlrefer);
    exit();
    