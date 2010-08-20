<?php
class Solow_Form_Element_SelectIterate extends Zend_Form_Element_Select
{
    protected $elements;
    protected $ChildrenIteratorKey;
    protected $iterationCase = array();
    protected $optionKeys = array();

    public function setIterateOver($over)
    {
        if(is_array($over) || is_object($over))
        {
            $this->elements = $over;
        }
        else
        {
            
            Throw new Exception('Non-iteratable value supplied for setIterateOver');
        }
    }

    public function setIterateOverRange($start, $end)
    {
        if($end >= $start)
        {
            $rangeArray = array();
            for($start; $start<=$end; $start++)
            {
                $rangeArray[] = $start;
            }
            $this->elements = $rangeArray;
        }
        else
        {
            Throw new Exception('End value is higher than start value.');
        }
    }

    public function setIterateOn(Zend_Validate_Abstract $validator)
    {
        $this->iterationCase[] = $validator;
    }

    public function setIterateOnArray($validators)
    {
        if(is_array($validators))
        {
            $this->iterationCase[] = $validators;
        }
    }

    public function setDefault($default)
    {
        $this->setValue($default);
    }

    public function buildElement()
    {
        $this->iterate($this->elements);
        unset($this->elements);
        unset($this->iterationCase);
        unset($this->optionKeys);
        unset($this->ChildrenIteratorKey);
    }

    public function setChildrenIteratorKey($key)
    {
        $this->ChildrenIteratorKey = $key;
    }

    protected function iterate($elements)
    {
        if(is_array($elements))
        {
            foreach($elements as $element)
            {
                if(isset($this->optionKeys['value']))
                {
                    $this->addMultiOption($element[$this->optionKeys['option']], $element[$this->optionKeys['value']]);
                }
                elseif(isset($this->optionKeys['option']))
                {
                    $this->addMultiOption($element[$this->optionKeys['option']], $element[$this->optionKeys['option']]);
                }
                else
                {
                    $this->addMultiOption($element, $element);
                }
                if($this->validateElement($element))
                {
                    if(!empty($this->ChildrenIteratorKey))
                    {
                        $this->iterate($element[$this->ChildrenIteratorKey]);
                    }
                    else
                    {
                        $this->iterate($element);
                    }
                }
            }
        }
        elseif(is_object($elements))
        {
            foreach($elements as $element)
            {
                if(isset($this->optionKeys['value']))
                {
                    $this->addMultiOption($element->{$this->optionKeys['option']}, $element->{$this->optionKeys['value']});
                }
                else
                {
                    $this->addMultiOption($element->{$this->optionKeys['option']});
                }
                if($this->validateElement($element))
                {
                    if(!empty($this->ChildrenIteratorKey))
                    {
                        $this->iterate($element->{$this->ChildrenIteratorKey});
                    }
                    else
                    {
                        $this->iterate($element);
                    }
                }
            }
        }
    }

    protected function validateElement($element)
    {
        foreach($this->iterationCase as $validator)
        {
            if(is_array($validator))
            {
                foreach($validator as $groupItem)
                {
                    if(is_array($groupItem))
                    {
                        foreach($groupItem as $item)
                        {
                            if(!$item->isValid($element))
                            {
                                return false;
                            }
                        }
                        return true;
                    }
                    else
                    {
                        if(!$groupItem->isValid($element))
                        {
                            return false;
                        }
                    }
                }
                return true;
            }
            else
            {
                if($validator->isValid($element))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
    }

    public function setOptionKeys($option, $value)
    {
        $this->optionKeys['option'] = $option;
        $this->optionKeys['value'] = $value;
    }
}