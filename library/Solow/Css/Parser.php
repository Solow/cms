<?php
class Solow_Css_Parser
{                    
    protected $declerationGroups = array();
    protected $variables = array();
    protected $constants = array();      
    protected $_spacing = '    ';
    
    public function __construct($cssString)
    {                               
        $this->extractCss($cssString);
    }   
    
    public function __toString()
    {
        return ''.$this->parseStylesheet();  
    }  
    
    public function parseStylesheet()
    {
        $temp = "";
        foreach($this->declerationGroups as $selector=>$declerationGroup)
        {
            $temp.=$selector.PHP_EOL."{".PHP_EOL;
            $parsedProperties=$declerationGroup->getParsedProperties();                   
            $parsedProperties = preg_replace_callback('/var\(([^)]+)\)/', array($this, "getVariableRegex"), $parsedProperties);
            $parsedProperties = preg_replace_callback('/constant\(([^)]+)\)/', array($this, "getConstantRegex"), $parsedProperties);
            $temp .= substr($parsedProperties, 0, -1);
            $temp.=PHP_EOL."}".PHP_EOL.PHP_EOL;
        }
        return $temp;         
    }
    
    protected function getVariableRegex($match)
    {         
        return $this->variables[$match[1]];   
    }
    
    protected function getConstantRegex($match)
    {         
        return $this->constants[$match[1]];   
    }
    
    protected function extractCss($cssString)
    {
        preg_match_all('#([^{]+?)\{([^}]+?)\}#i', $cssString, $matches);   
        foreach($matches[1] as $key=>$tag)
        {             
            $tag=trim($tag);
            if(strtolower($tag) == "@variables")
            {
                $this->setVariables($tag, $matches[2][$key]);        
            }
            elseif(strtolower($tag) == "@define")
            {
                $this->setConstants($tag, $matches[2][$key]);        
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
        $this->declerationGroups[$tag] = new Solow_Css_DeclarationGroup($tag, $string);   
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
    
    protected function setVariables($selector, $declarations)
    {                        
        $properties = $this->getCleanedProperties($declarations);
        foreach($properties as $property)
        {
            $propertyValue = explode(':',$property);
            $this->setVariable(trim($propertyValue[0]),  trim($propertyValue[1]));
        }                                                 
    }
    
    protected function setConstants($selector, $declarations)
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
