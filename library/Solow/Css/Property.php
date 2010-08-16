<?php
class Solow_Css_Property
{
    protected $property;
    protected $value;
    
    public function __construct($property, $value)
    {
        $this->property = $property;
        $this->value = $value;
    }
    
    public function renderProperty()
    {
        return $this->property.": ".$this->value.";";
    }
}
