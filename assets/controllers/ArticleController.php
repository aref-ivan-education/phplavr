<?
namespace controller;

use core\DB;
use models\ArticleModel;
use models\UserModel;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        $mArticle = new ArticleModel(Db::connect());
        $articles = $mArticle->getAll();

        $this->content = $this->build('v_home',["articles"=>$articles]);
    }
}