<?php

namespace JoacubBase;

use JoacubBase\View\Helper\Locale;
use Zend\Mvc\MvcEvent;
use Nette\Diagnostics\Debugger;
class Module
{
	
	public function onBootstrap(MvcEvent $e)
	{
		$eventManager        = $e->getApplication()->getEventManager();
		
		$eventManager->attach(MvcEvent::EVENT_RENDER, array($this,'onRender'), 100);
	
	}
	
	public function onRender(MvcEvent $e)
	{
		if(PHP_SAPI != 'cli') {
			$view = $e->getApplication()->getServiceManager()->get('viewrenderer');
			$view->inlineScript()->appendScript('var site_url = "'.$view->basePath().'";');
		}
	}
	
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getControllerPluginConfig()
    {
    	return array(
    		'invokables' => array(
    			'backTo' => 'JoacubBase\Mvc\Controller\Plugin\BackTo'
    		),
    	);
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'joacubBaseQueryParams' => 'JoacubBase\View\Helper\QueryParams',
            	'joacubBaseHtmlCutter' => 'JoacubBase\View\Helper\HtmlCutter'
            ),
            'factories' => array(
                'joacubBaseLocale' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $viewHelper = new Locale();
                    $viewHelper->setLocaleDetector($locator->get('SlmLocale\Locale\Detector'));
                    return $viewHelper;
                },
            )
        );
    }
}
