<?php
class Solow_Controller_Router_Route_DbRoute extends Zend_Controller_Router_Route_Abstract
{
	public function match($path)
	{
            /*try {
		$uri = rtrim($path->getPathInfo(),'/');
                $page = Lupi_Mapper::_('Pages')->find($uri, 'slug');
                if (sizeof($page) != 1) {
                    return false;
                }
                $page = current($page);
                $return = array('controller' => 'pages',
                                'action' => 'page',
                                'module' => 'default',
                                'page' => $page);
            } Catch (Exception $e) {
                die($e->getMessage());
            }
		return $return;
             *
             */
            echo "<pre>";
            $uri =  trim($path->getPathInfo(),'/');
            $params = explode('/', $uri);
            $page = array_shift($params);
            echo $page."<br />";
            print_r($params);
            die();
	}
	public function assemble($data = array(), $reset = false, $encode = false)
        {
            return $this->_route;
        }

	public static function getInstance(Zend_Config $config)
	{
	}
}