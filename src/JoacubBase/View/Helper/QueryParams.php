<?php
namespace JoacubBase\View\Helper;
use Zend\View\Helper\AbstractHelper;
use Zend\EventManager\StaticEventManager;
use Zend\Mvc\Router\Http\Query;
use Nette\Diagnostics\Debugger;

class QueryParams extends AbstractHelper
{

	/**
	 *
	 * @param array $params        	
	 * @param bool $reset        	
	 * @return string
	 */
	public function __invoke ($params = array(), $reuseMatchedParams = true, 
			$resetCurrentParams = false)
	{
		$currentParams = array();
		
		if (! $resetCurrentParams) {
			$queryString = urldecode($_SERVER['QUERY_STRING']);
			parse_str($queryString, $currentParams);
		}
		
		$url = $this->getView()->url(null, array(), array(), $reuseMatchedParams);
		
		if (strstr($url, '?')) {
			$queryArray = array_merge($currentParams, $params);
			return $this->getView()->url(null, $queryArray, array(), 
					$reuseMatchedParams);
			;
		}
		
		$queryString = http_build_query(array_merge($currentParams, $params));
		return $this->getView()->url(null, array(), array(), $reuseMatchedParams) . '?' . $queryString;
        
    }
}
