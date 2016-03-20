<?php

class View
{
    public static function render($code, $output, $template = 'template.php')
    {
        include dirname(__FILE__) . '/' . $template;
    }
}