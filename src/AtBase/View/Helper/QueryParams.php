<?php

namespace AtBase\View\Helper;

use Zend\View\Helper\AbstractHelper;

class QueryParams extends AbstractHelper
{
    /**
     * @param array $params
     * @param bool $reset
     * @return string
     */
    public function __invoke($params = array(), $reuseMatchedParams = true, $resetCurrentParams = false)
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

        $queryString = http_build_query(array_merge($currentParams, $params));

        return $this->getView()->url(null, array(), array(), $reuseMatchedParams) . '?' . $queryString;
    }
}
