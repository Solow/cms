<?php
class Solow_Components_Component_Text extends Solow_Components_Abstract
{
    protected $title;
    protected $body;

    protected function init()
    {
        $this->getText();
    }

    public function getText()
    {
        $text = Solow_Mapper::_('text')->getText($this->page->spec);
        $this->title = $text['title'];
        $this->body = $text['content'];
    }

    protected function render()
    {
        $rendered = (!empty($this->title)) ? 
            "<h1>$this->title</h1>".PHP_EOL."<p>$this->body</p>".PHP_EOL : "<p>$this->body</p>".PHP_EOL;
        return $rendered;
    }

    public function __toString()
    {
        return $this->render();
    }
}
