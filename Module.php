<?php

namespace JoacubBase;

class Module
{
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

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'joacubBaseQueryParams' => 'JoacubBase\View\Helper\QueryParams',
                'joacubBaseLocale' => 'JoacubBase\View\Helper\Locale',
            ),
        );
    }
}
