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
    public function __construct()
	{
		$this->title = 'Новости';
		$this->content = '';
	}

	public function error404()
	{
		$this->title = "Страница не найдена";
		$this->content = $this->build(__DIR__.'/../v/v_404.php');
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
					'categores' => $caterores
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

}