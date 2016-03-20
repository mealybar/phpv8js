<?php

class View
{
    public static function render($php, $javascript, $output, $template = 'template.php')
    {
        include dirname(__FILE__) . '/' . $template;
    }
}