<?php

namespace JoacubBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\EventManager\StaticEventManager;
use Zend\Mvc\Router\Http\Query;
use SlmLocale\Locale\Detector;

class Locale extends AbstractHelper
{
    
    /**
     * 
     * @var Detector
     */
    protected $localeDetector;
    
    /**
     * @param array $params
     * @param bool $reset
     * @return string
     */
    public function __invoke()
    {
        return $this;
    }
    
    public function getLocaleSupported()
    {
        $localeDetector = $this->getLocaleDetector();
        $locales = $localeDetector->getSupported();
        
        return $locales;
    }
    
    public function setLocaleDetector($localeDetector)
    {
        $this->localeDetector = $localeDetector;
        return $this;
    }
    
    public function getLocaleDetector()
    {
        return $this->localeDetector;
    }
    
    public function __toString()
    {
        return $this->getLocaleDetector()->getDefault();
    }
}
