<?php
namespace controller;

class BaseController
{
    protected $title;
    protected $content;
    public function __construct()
	{
		$this->title = 'Новости';
		$this->content = '';
	}

    public function render()
	{
		echo $this->build(
				__DIR__ . '/../v/v_main.php',
				[
					'title' => $this->title,
					'content' => $this->content
				]
			 );
	}

    protected function build(string $template, array $param = [])
    {
        extract($param);
		
		ob_start();
		include sprintf('../v/%s.php',$template);

		return ob_get_clean();
    }

}