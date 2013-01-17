<?php

namespace JoacubBase\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\EventManager\StaticEventManager;
use Zend\Mvc\Router\Http\Query;

class Locale extends AbstractHelper
{
    /**
     * @param array $params
     * @param bool $reset
     * @return string
     */
    public function __invoke()
    {
        $currentParams = array();

        if (!$resetCurrentParams) {
            $queryString = $_SERVER['QUERY_STRING'];

            $currentParamPairs = explode('&', $queryString);

            if (!empty($currentParamPairs[0])) {
                foreach ($currentParamPairs as $pair) {
                    $data = explode('=', $pair);
                    $currentParams[$data[0]] = urldecode($data[1]);
                }
            }
        }

        $url = $this->getView()->url(null, array(), array(), $reuseMatchedParams);
        
        if(strstr($url, '?')) {
            $queryArray = array_merge($currentParams, $params);
            return $this->getView()->url(null, $queryArray, array(), $reuseMatchedParams);;
        }
        
        $queryString = http_build_query(array_merge($currentParams, $params));
        return $this->getView()->url(null, array(), array(), $reuseMatchedParams) . '?' . $queryString;
        
    }
}
