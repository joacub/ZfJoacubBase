<?php
$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);
return array(
    'Zend\\Session\\SessionManager' => $vendorDir . '/zf-joacub-base/src/JoacubBase/Session/SessionManager.php',
    'Zend\Cache\Storage\Adapter\\MemcachedResourceManager' => $vendorDir . '/zf-joacub-base/src/JoacubBase/Cache/Storage/Adapter/MemcachedResourceManager.php',
);