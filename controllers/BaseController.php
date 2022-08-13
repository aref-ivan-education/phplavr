<?php
namespace controllers;

use core\DB;
use core\DBDriver;
use core\Request;
use models\CategoryModel;
use models\UserModel;

class BaseController
{
    protected $title;
    protected $content;
	protected $msg404;
	protected $request;

    public function __construct(Request $request)
	{
		$this->request = $request;
		$this->title = 'Новости';
		$this->content = '';
		$this->msg404 = "Страница не найдена";
	}

	public function error404()
	{
		
		$this->title = "Страница не найдена";
		header("HTTP/1.1 404 Not Found");
		$this->content = $this->build('v_404',['msg' =>$this->msg404]);
	}

    public function render()
	{
		$mCategory = new CategoryModel(new DBDriver(DB::getConnect()));
		$caterores = $mCategory->getAll();
		echo $this->build(
				'v_main',
				[
					'title' => $this->title,
					'content' => $this->content,
					'categores' => $caterores,
					'userName' => $this->request->session('userName'),
					'isAuth' => $this->request->session('isAuth')
				]
			 );
	}

    protected function build(string $template, array $param = [])
    {
        extract($param);
		$template = sprintf('v/%s.php',$template);	
		ob_start();
		include $template;

		return ob_get_clean();
    }

	

}