<?php 
  defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
  defined('SITE_ROOT') ? null : define('SITE_ROOT', __DIR__);

  defined('INC_PATH') ? null : define('INC_PATH', dirname(__DIR__) . DS . 'includes');
  defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT);

  require_once(INC_PATH . DS . "config.php");
  require_once(CORE_PATH . DS . "post.php");
?>