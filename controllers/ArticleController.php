<?
namespace controllers;

use core\DB;
use core\Check;
use core\Request;
use models\ArticleModel;
use models\CategoryModel;
use models\UserModel;

class ArticleController extends BaseController
{
    public function indexAction()
    {
        $mArticle = new ArticleModel(DB::getConnect());
        $articles = $mArticle->getAll();

        $this->content = $this->build('v_home',["articles"=>$articles]);
    }

    public function postAction($msg = "")
    {
        $mArticle = new ArticleModel(DB::getConnect());
        $id=$this->request->get('get','id');
        if($article = $mArticle->getByID($id))
        {
            $this->content = $this->build(
                                        'v_post',
                                        [
                                        'article' => $article,
                                        'isAuth' => $this->request->get('session','isAuth'),
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
        $aModel = new ArticleModel(DB::getConnect());
        // $uModel = new UserModel(DB::getConnect());
        $catModel = new CategoryModel(DB::getConnect());
        
        $categores = $catModel->getAll();

        if($this->request->isPost())
        {
            $title = Check::cleanInput($this->request->get('post','title'));
            $content = Check::cleanInput($this->request->get('post','content'));			
            $category = Check::cleanInput($this->request->get('post','category'));
            $autor = $this->request->get('session','userId');
            
            
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

        $this->content = $this->build(__DIR__ . 'post_add',
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
        $aModel = new ArticleModel(DB::getConnect());
        $catModel = new CategoryModel(DB::getConnect());
        $msg="";
        $id = $this->request->get('get',"id");
        if($article = $aModel->getByID($id) ){
            $autor = $article['user']??"";
            $categores = $catModel->getAll();
    
            if($this->request->isPost())
            {
                $titlePost = Check::cleanInput($this->request->get('post','title'));
                $contentPost = Check::cleanInput($this->request->get('post','content'));
                $category = Check::cleanInput($this->request->get('post','category'));
        
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
        
                    $aModel->updateByID($id , $updateData);
                    header("Location: /articles/post/".$id);
                    exit();
                }
                
            }
    
            $this->content = $this->build(
                             "v_post_edit",
                            [
                            'article' => $article,
                            'categores' => $categores,
                            'msg' => $msg,
                            'isAuth' => $this->request->get('session','isAuth')  
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
        $aModel = new ArticleModel(DB::getConnect());
        $id = $this->request->get('get','id');
        if($aModel->getByID($id))
        {
            $aModel->deleteByID($id);
            header('Location: /');

        }
        else
        {
            $this->msg404 = "Что-то пошло не так";
            $this->error404();
        }

    }
}