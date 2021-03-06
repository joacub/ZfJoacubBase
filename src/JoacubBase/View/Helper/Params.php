<?php

namespace JoacubBase\View\Helper;

use Zend\Mvc\MvcEvent;
use Zend\Stdlib\RequestInterface;
use Zend\View\Helper\AbstractHelper;
use Nette\Diagnostics\Debugger;

class Params extends AbstractHelper
{
    protected $request;

    protected $event;

    public function __construct(RequestInterface $request, MvcEvent $event)
    {
        $this->request = $request;
        $this->event = $event;
        return $this;
    }
    
	public function __invoke($param = null, $default = null)
    {
        if ($param === null) {
            return $this;
        }
        return $this->fromRoute($param, $default);
    }

    public function fromPost($param = null, $default = null)
    {
        if ($param === null)
        {
            return $this->request->getPost($param, $default)->toArray();
        }

        return $this->request->getPost($param, $default);
    }

    public function fromRoute($param = null, $default = null)
    {
        if(!$this->event->getRouteMatch())
            throw new \Exception('No existe el router');

        if ($param === null)
        {
            return $this->event->getRouteMatch()->getParams();
        }

        return $this->event->getRouteMatch()->getParam($param, $default);
    }
    
    public function fromQuery($param = null, $default = null)
    {
    	if ($param === null)
    	{
    		return $this->request->getQuery($param, $default)->toArray();
    	}
    	
    	return $this->request->getQuery($param, $default);
    }
    
}