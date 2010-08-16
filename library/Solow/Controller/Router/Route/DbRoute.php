<?php
class Solow_Controller_Router_Route_DbRoute extends Zend_Controller_Router_Route_Abstract
{
	public function match($path)
	{
        if(!$page = Solow_Mapper::_('pages')->find($path))
        {
            return false;
        }
        else
        {
            $return = array(
                'controller' => 'pages',
                'action' => 'page',
                'module' => 'default',
                'page' => $page
            );
        }
        return $return;
	}
	public function assemble($data = array(), $reset = false, $encode = false)
        {
            return $this->_route;
        }

	public static function getInstance(Zend_Config $config)
	{
	}
}