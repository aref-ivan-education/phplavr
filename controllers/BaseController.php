<?php
namespace controllers;

use core\DB;
use models\CategoryModel;
use models\UserModel;

class BaseController
{
    protected $title;
    protected $content;
	protected $id;
	protected $userName;
	protected $isAuth;
	protected $msg404;

    public function __construct()
	{
		$this->title = 'Новости';
		$this->content = '';
		$this->msg404 = "Страница не найдена";
	}

	public function error404()
	{
		
		$this->title = "Страница не найдена";
		header("HTTP/1.0 404 Not Found");
		$this->content = $this->build(__DIR__.'/../v/v_404.php',['msg' =>$this->msg404]);
	}

    public function render()
	{
		$mCategory = new CategoryModel(DB::connect());
		$caterores = $mCategory->getAll();
		echo $this->build(
				__DIR__ . '/../v/v_main.php',
				[
					'title' => $this->title,
					'content' => $this->content,
					'categores' => $caterores,
					'userName' => $this->userName,
					'isAuth' => $this->isAuth
				]
			 );
	}

    protected function build(string $template, array $param = [])
    {
        extract($param);
		
		ob_start();
		include $template;

		return ob_get_clean();
    }

	public function setID($id)
	{
		$this->id = $id;
	}
	public function setUserName($userName)
	{
		$this->userName = $userName;
	}
	public function setIsAuth($isAuth)
	{
		$this->isAuth = $isAuth;
	}


}