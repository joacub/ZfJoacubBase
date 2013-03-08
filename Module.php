<?php

namespace JoacubBase;

use JoacubBase\View\Helper\Locale;
class Module
{
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
