<?php
class Solow_View_Helper_Page
{
    protected $areas = array();
    protected $availableAreas = array();

    public function page()
    {
        return $this;
    }

    public function appendArea($area, $content)
    {
        $this->areas[$area][] = $content;
    }

    public function defineArea($area, $identifier, $description, $wrapper, $attributes=NULL)
    {
        $this->availableAreas[$identifier] = array
        (
            'description'=>$description,
            'wrapper'=>$wrapper,
            'attributes'=>$attributes
        );
        return $this->renderArea($area, $identifier, $wrapper, $attributes);
    }

    protected function renderArea($area, $identifier, $wrapper, $attributes=NULL)
    {
        $areaOutput = "<$wrapper id=\"$identifier\"";
        if($attributes !== NULL)
        {
            foreach($attributes as $attr=>$value)
            {
                $areaOutput .= " $attr=\"$value\"";
            }
        }
        $areaOutput .= ">".PHP_EOL;
        if(isset($this->areas[$area]))
        {
            foreach($this->areas[$area] as $areaX)
            {
                $areaOutput .= $areaX.PHP_EOL;
            }
        }
        $areaOutput .= "</$wrapper>".PHP_EOL;
        return $areaOutput;
    }
}