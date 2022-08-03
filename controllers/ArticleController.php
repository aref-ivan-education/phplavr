<?
namespace controllers;

use core\DB;
use models\ArticleModel;
use models\UserModel;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        $mArticle = new ArticleModel(Db::connect());
        $articles = $mArticle->getAll();

        $this->content = $this->build(__DIR__ . '/../v/v_home.php',["articles"=>$articles]);
    }
}