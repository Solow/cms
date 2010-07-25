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
            $uriFormat = Solow_Mapper::_('settings')->getOption('uriFormat');
            $preSlug = rtrim($path->getPathInfo(), '/');
            switch($uriFormat)
            {
                case '.html':
                    $preSlug = str_replace('.html', '', $preSlug);
                    $preSlug = explode('_', $preSlug);
                    $us = true;
                    break;
                case '_':
                    $preSlug = explode('_', $preSlug);
                    $us = true;
                    break;
                case '/':
                    $preSlug = explode('/', $preSlug);
                    $us = true;
                    break;
                case 'id':
                    $preSlug = ltrim($preSlug, '/');
                    $preSlug = explode('/', $preSlug);
                    $id = array_shift($preSlug);
                    $us = false;
                    break;
                default:
                    break;
            }

            if($us)
            {
                $slug = implode('/', $preSlug);
                die($slug);
                #if($this->checkExistence('slug', $slug))
                #{

                #}
            }
            else
            {
                echo $id;
                //    /community/forum/view/topic/een-topic-title-hier

                #Alle pagina's met modules opslaan, en inladen bij init, en matchen met url, alles erachter zijn params.
                
            }


            /*echo "<pre>";
            $uri =  trim($path->getPathInfo(),'/');
            $params = explode('/', $uri);
            $page = array_shift($params);
            echo $page."<br />";
            print_r($params);
             * */
            
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