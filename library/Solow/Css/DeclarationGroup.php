<?php
class Solow_Css_DeclarationGroup
{
    protected $properties = array();  
    
    public function __construct($selector, $declarations)
    {
        $this->setProperties($selector, $declarations);   
    }
    
    protected function setProperties($selector, $declarations)
    {        
        $properties = $this->getCleanedProperties($declarations);             
        foreach($properties as $property)
        {
            $propertyValue = explode(':',$property, 2);
            $this->setProperty(trim($propertyValue[0]),  trim($propertyValue[1]));
        }                                                 
    }
    
    protected function getCleanedProperties($declarations)
    {
        $properties = array_filter(array_map('trim', explode(";", $declarations)));
        return $properties;
    }
    
    public function setProperty($property, $value)
    {
        $this->properties[$property] = new Solow_Css_Property($property, $value);
    }
    
    public function removeProperty($property)
    {
        unset($this->properties[$property]);
    }
    
    public function getParsedProperties($spacing="    ")
    {
        $temp="";
        foreach($this->properties as $property => $propertyObject)
        {
            $temp.=$spacing.$propertyObject->parseProperty().PHP_EOL;    
        }
        return $temp;
    }
}
