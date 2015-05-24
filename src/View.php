<?php

namespace Tiga\Framework;
use Tiga\Framework\Facade\TemplateFacade as Template;


class View 
{
	
	protected $buffer;

	protected $title;
	
	protected $response;

	protected $template = false;
	
	protected $templateParameters;

	function __construct() 
	{
		add_filter('template_include', array($this,'overrideTemplate'),10,1);	
	}

	function setTemplate($template,$templateParameters) 
	{
		$this->template = $template;
		$this->templateParameters = $templateParameters;
	}

	function setResponse($response)
	{
		$this->response = $response;
	}

	function sendResponse()
	{
		if($this->response instanceof SymfonyResponse){
        	$this->response->sendContent();
        }

        if($this->template!==false)
        	echo Template::render($this->template,$this->templateParameters);
	}

	function setBuffer($buffer) 
	{
		$this->buffer = $buffer;
	}

	function getBuffer() 
	{		
		return $this->buffer;
	}

	public function overrideTemplate() 
	{
		//Disable rewrite, lighter access for LF
		global $wp_rewrite;

		$wp_rewrite->rules = array();

		return TIGA_BASE_PATH.'/src/ViewGenerator.php';
	}
}

