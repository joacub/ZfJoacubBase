<?php

namespace JoacubBase;

use JoacubBase\View\Helper\Locale;
use Zend\Mvc\MvcEvent;
use Nette\Diagnostics\Debugger;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use JoacubBase\Doctrine\Extensions\TablePrefix;
use Zend\ServiceManager\ServiceLocatorInterface;
use JoacubBase\View\Helper\Params;
class Module implements ServiceProviderInterface
{
	
	public function onBootstrap(MvcEvent $e)
	{
		$eventManager        = $e->getApplication()->getEventManager();
		
//		$eventManager->attach(MvcEvent::EVENT_RENDER, array($this,'onRender'), 100);
	
	}
	
	public function onRender(MvcEvent $e)
	{
		if(PHP_SAPI != 'cli') {
			$view = $e->getApplication()->getServiceManager()->get('viewrenderer');
			$view->inlineScript()->appendScript('var site_url = "'.substr($view->url('home'), 0, -1).'";');
		}
	}
	
	public function getConfig() {
		return include __DIR__ . '/config/module.config.php';
	}
	
    public function getAutoloaderConfig()
    {
        return array(
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
            	'params' => function (ServiceLocatorInterface $helpers)
            	{
            		$services = $helpers;
            		$app = $services->get('Application');
            		return new Params($app->getRequest(), $app->getMvcEvent());
            	},
                'joacubBaseLocale' => function ($sm) {
                    $locator = $sm->getServiceLocator();
                    $viewHelper = new Locale();
                    $viewHelper->setLocaleDetector($locator->get('SlmLocale\Locale\Detector'));
                    return $viewHelper;
                },
            )
        );
    }
    
    public function getServiceConfig()
    {
    	return array(
    		
    		'factories' => array(
    			'JoacubBase\Doctrine\Extensions\TablePrefix' => function($sm) {
    				$config = $sm->get('config');
    				if(!isset($config['joacub-base']['doctrine']['table_prefix'])) {
    					$config['joacub-base']['doctrine']['table_prefix'] = null;
    				} else {
    					$config['joacub-base']['doctrine']['table_prefix'] .= '_';
    				}
    				return new TablePrefix($config['joacub-base']['doctrine']['table_prefix']);
    			}
    		)
    		
    	);
    }
}
