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

    public function postAction()
    {
        $mArticle = new ArticleModel(DB::connect());
        if($article = $mArticle->getByID($this->id))
        {
            $this->content = $this->build(__DIR__ . '/../v/v_post.php',['article' => $article,]);
            $this->title = $article['title'];
        }
        else
        {
            $this -> error404();
        }
    }
}