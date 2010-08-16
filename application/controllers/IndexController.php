<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        $this->view->SetTheme('default');
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity())
        {
            $username = $auth->getStorage()->read()->salt;
            $url = $this->view->url(array('controller'=>'auth',
            'action'=>'logout'), null, true);
            $this->view->message = 'Welcome '.$username.'<a href="'.$url.'">Logout</a>';
        }
        else
        {
            $url = $this->view->url(array('controller'=>'auth',
            'action'=>'index'), null, true);
            $this->view->message = 'You\'re currently not logged in. <a href="'.$url.'">Login</a>';
        }


        $test = '
            @variables
            {
                    someVar: SomeKey;
                    someOtherVar: SomeOtherKey;
                    widthGen: 100%;
                    image: someCrappyImage.jpg;
            }

            @Constants
            {
                someMarginConstant: nothing to do with margin ROFL!;
            }

            #header{             
                width: var(widthGen);
                height: 95px;
                background-image: url("var(image)");
                background-repeat: no-repeat;
                background-position: left;
                clear: both;
            }

                    #stranglyPlaced
                    {
                    width: var(widthGen); height: 150px;
                    clear: both;
                        margin: var(someMarginConstant);
                    }

                    .oneLiner{width:100%;height:150px;clear:both; margin:0 auto;}
            ';

        $testInstance = new Solow_Css_Parser($test);
        $testInstance->setProperty('.oneLiner', 'non-existant', 'bullcrap');
        $testInstance->setProperty('.oneLiner', 'bullVar', 'var(v)');
        $testInstance->setVariable('v', '#000');
        $testInstance->setConstant('c', 'red');
        $testInstance->setProperty('.oneLiner', 'bullConst', 'var(c)');
        echo "<br /><pre>";
        echo $testInstance;
    }


}

