<?
namespace core;

class Request
{
    private $get;
    private $post;
    private $server;
    private $cookie;
    private $files;
    private $session;

	private const METHOD_POST = 'POST' ;

    public function __construct($get, $post, $server, $cookie, $file, $session)
	{
		$this->get = $get;
		$this->post = $post;
		$this->server = $server;
		$this->cookie = $cookie;
		$this->file = $file;
		$this->session = $session;
	}

    public function get($property, $key=null)
    {
        
		if (!$key) {
			return $this->$property;
		}

		if (isset($this->$property[$key])) {
			return $this->$property[$key];
		}

		return null;
    }
	
    public function isPost()
	{
		return $this->server['REQUEST_METHOD']==self::METHOD_POST;
	}
}