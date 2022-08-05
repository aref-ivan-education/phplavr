<?
namespace controllers;

use core\DB;
use core\Check;
use models\ArticleModel;
use models\CategoryModel;
use models\UserModel;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        $mArticle = new ArticleModel(DB::connect());
        $articles = $mArticle->getAll();

        $this->content = $this->build(__DIR__ . '/../v/v_home.php',["articles"=>$articles]);
    }

    public function postAction($msg = "")
    {
        $mArticle = new ArticleModel(DB::connect());
        if($article = $mArticle->getByID($this->id))
        {
            $this->content = $this->build(
                                        __DIR__ . '/../v/v_post.php',
                                        [
                                        'article' => $article,
                                        'isAuth' => $this->isAuth,
                                        'msg'=> $msg
                                        ]
                                        );
            $this->title = $article['title'];
        }
        else
        {
            $this -> msg404 = 'Новость потерялась';
            $this -> error404();
        }
    }

    public function addAction()
    {
        $aModel = new ArticleModel(DB::connect());
        // $uModel = new UserModel(DB::connect());
        $catModel = new CategoryModel(DB::connect());
        
        $categores = $catModel->getAll();

        if(count($_POST) > 0)
        {
            $title = Check::cleanInput($_POST['title']);
            $content = Check::cleanInput($_POST['content']);			
            $category = Check::cleanInput($_POST['category']);
            $autor = $this->userName;
            
            if($title == '' || $content == '')
            {
                $msg = 'Заполните все поля';
            }

            elseif(!Check::correct($title,"#^[a-zA-Z0-9а-яА-Я-\s]+$#u"))
            {
                $msg = "Название должно содержать только буквы, числа и знак '-'";
            }
            elseif(!Check::allowLenth($title,2,50))
            {
                $msg = "Навание должно быть не менее 2 и не более 50 символов";
            }
            elseif(!Check::allowLenth($content,10,250))
            {
                $msg = "Cтатья должна содердать не менее 10, но не более 250 символов ";
            }


            else{

                $set=$aModel->add(['title'=>$title,
                                'content'=>$content,
                                'id_cat'=>$category,
                                'id_user'=>$autor,
                                ]);
                                
                header("Location: /articles/post/".$set);
                exit();
            }
        }
        else{
            $title = '';
            $content ='';
            $msg = '';
        }

        $this->content = $this->build(__DIR__ . '/../v/v_post_add.php',
                                    [
                                    'title'=>$title,
                                    'content'=>$content,
                                    'msg'=>$msg,
                                    'categores'=>$categores,
                                    
                                    ]);
        $this->title = "Добавление статьи";
    }

    public function editAction()
    {
        $aModel = new ArticleModel(DB::connect());
        $catModel = new CategoryModel(DB::connect());
        $msg="";

        if($article = $aModel->getByID($this->id) ){
            $autor = $article['user']??"";
            $categores = $catModel->getAll();
    
            if(count($_POST) > 0){
                $titlePost = Check::cleanInput($_POST['title']);
                $contentPost = Check::cleanInput($_POST['content']);
                $category = Check::cleanInput($_POST['category']);
        
                if($titlePost == '' || $contentPost == '')
                {
                    $msg='Все поля должны быть заполнены';
                }
                elseif(!Check::correct($titlePost,"#^[a-zA-Z0-9а-яА-Я-\s]+$#u"))
                {
                    $msg = "Название должно содержать только буквы, числа и знак '-'";
                }
                elseif(!Check::allowLenth($titlePost,2,50))
                {
                    $msg = "Навание должно быть не менее 2 и не более 50 символов";
                }
                elseif(!Check::allowLenth($contentPost,10,250))
                {
                    $msg = "Cтатья должна содердать не менее 10, но не более 250 символов ";
                }

                elseif($titlePost==$article['title']&&$contentPost==$article['content']&&$category==$article['id_cat'])
                {
                    $msg= 'Статья не изменена';
                }
                else{
                    $updateData=[  
                                'title'=>$titlePost,
                                'content'=>$contentPost,
                                'id_cat'=>$category,
                                'id_user'=>$autor,
      
                    ]   ;
        
                    $aModel->updateByID($this->id , $updateData);
                    header("Location: /articles/post/".$this->id);
                    exit();
                }
                
            }
    
            $this->content = $this->build(
                            __DIR__. "/../v/v_post_edit.php",
                            [
                            'article' => $article,
                            'categores' => $categores,
                            'msg' => $msg,
                            'isAuth' => $this->isAuth   
                            ]) ;        
            $this->title = "Редактирование статьи : " . $article['title'] ;
        }
        else
        {       
            $this->error404();       
        }


    }

    public function deleteAction()
    {
        $aModel = new ArticleModel(DB::connect());

        if($aModel->getByID($this->id))
        {
            $aModel->deleteByID($this->id);
            header('Location: /');

        }
        else
        {
            $this->msg404 = "Что-то пошло не так";
            $this->error404();
        }

    }
}