<?php
class Solow_Css_Parser
{                    
    protected $declerationGroups = array();
    protected $variables = array();
    protected $constants = array();      
    protected $_spacing = '    ';
    protected $errors = array();
    
    public function __construct($cssString)
    {                               
        $this->extractCss($cssString);
    }   
    
    public function __toString()
    {
        return $this->renderStylesheet();
    }

    protected function addError($error, $type="Warning")
    {
        $this->errors[] = $type.": ".$error;
    }

    public function getErrors()
    {
        return $this->errors;
    }
    
    public function renderStylesheet()
    {
        $temp = "";
        foreach($this->declerationGroups as $selector=>$declerationGroup)
        {
            $temp.=$selector.PHP_EOL."{".PHP_EOL;
            $renderedProperties=$declerationGroup->getRenderedProperties();
            $renderedProperties = preg_replace_callback('/var\(([^)]+)\)/', array($this, "getVarRegex"), $renderedProperties);
            $temp .= substr($renderedProperties, 0, -1);
            $temp.=PHP_EOL."}".PHP_EOL.PHP_EOL;
        }
        return $temp;         
    }
    
    protected function getVarRegex($match)
    {
        if(isset($this->constants[$match[1]]) || isset($this->variables[$match[1]]))
        {
            if(isset($this->constants[$match[1]]))
            {
                return $this->constants[$match[1]];
            }
            else
            {
                return $this->variables[$match[1]];
            }
        }
        else
        {
            $this->addError('Non existant constant, or variable requested: <strong>'.$match[1].'</strong>');
            return '';
        }
    }
    
    protected function extractCss($cssString)
    {
        preg_match_all('#([^{]+?)\{([^}]+?)\}#i', $cssString, $matches);   
        foreach($matches[1] as $key=>$tag)
        {             
            $tag=trim($tag);
            if(strtolower($tag) == "@variables")
            {
                $this->setVariables($matches[2][$key]);        
            }
            elseif(strtolower($tag) == "@constants")
            {
                $this->setConstants($matches[2][$key]);        
            }  
            else
            {
                $this->setDeclerationGroup($tag, $matches[2][$key]);
            }         
        }
    }
    
    public function setSpacing($spacing)
    {
        $this->_spacing = $spacing;
    }
    
    public function setDeclerationGroup($tag, $string)
    {
        $this->declerationGroups[$tag] = new Solow_Css_DeclarationGroup($string);   
    }
    
    public function removeDeclerationGroup($tag)
    {
        unset($this->declerationGroups[$tag]);
    }                    
    
    public function setProperty($declerationGroup, $property, $value)
    {
        $this->declerationGroups[$declerationGroup]->setProperty($property, $value);  
    }
    
    public function removeProperty($declerationGroup, $property)
    {
        $this->declerationGroups[$declerationGroup]->removeProperty($property);  
    }
    
    protected function setVariables($declarations)
    {                        
        $properties = $this->getCleanedProperties($declarations);
        foreach($properties as $property)
        {
            $propertyValue = explode(':',$property);
            $this->setVariable(trim($propertyValue[0]),  trim($propertyValue[1]));
        }                                                 
    }
    
    protected function setConstants($declarations)
    {                        
        $properties = $this->getCleanedProperties($declarations);
        foreach($properties as $property)
        {
            $propertyValue = explode(':',$property);
            $this->setConstant(trim($propertyValue[0]),  trim($propertyValue[1]));
        }                                                 
    }
    
    public function setVariable($variable, $value)
    {
        $this->variables[$variable] = $value;
    }
    
    public function unsetVariable($variable)
    {
        unset($this->variables[$variable]);
    }
    
    public function setConstant($constant, $value)
    {
        $this->constants[$constant] = $value;
    }
    
    public function unsetConstant($constant)
    {
        unset($this->constants[$constant]);
    }
    
    protected function getCleanedProperties($declarations)
    {
        $properties = array_filter(array_map('trim', explode(";", $declarations)));
        return $properties;
    }
}  
