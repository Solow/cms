<?php
class Solow_Css_DecelerationGroup
{
    protected $properties = array();  
    
    public function __construct($decelarations)
    {
        $this->setProperties($decelarations);
    }
    
    protected function setProperties($decelarations)
    {        
        $properties = $this->getCleanedProperties($decelarations);
        foreach($properties as $property)
        {
            $propertyValue = explode(':',$property, 2);
            $this->setProperty(trim($propertyValue[0]),  trim($propertyValue[1]));
        }                                                 
    }
    
    protected function getCleanedProperties($decelarations)
    {
        $properties = array_filter(array_map('trim', explode(";", $decelarations)));
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
    
    public function getRenderedProperties($spacing="    ")
    {
        $temp="";
        foreach($this->properties as $property => $propertyObject)
        {
            $temp.=$spacing.$propertyObject->renderProperty().PHP_EOL;
        }
        return $temp;
    }
}
