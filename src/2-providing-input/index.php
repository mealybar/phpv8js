<?php

$v8 = new V8Js('PHPJS');

$codeTemplate = "PHPJS.output.result = function() { %s
}();";

require_once 'params.php';
$params = new Params($_POST);
$v8->Params = $params;

$code = <<<EOJS
var request = {
    name : PHPJS.Params.getName(),
    score : PHPJS.Params.getScore()
};

return request;
EOJS;

try {
    $v8->output = new stdClass();
    $v8->executeString(sprintf($codeTemplate, $code), 'example-2', V8Js::FLAG_FORCE_ARRAY);
    $returned = $v8->output->result;
}
catch (V8JsException $e) {
    $returned = [
        'error' => [
            'code' => $e->getCode(),
            'message' => $e->getMessage()
        ]
    ];
}

require dirname(__FILE__) . '/../helpers/view.php';
View::render($code, var_export($returned, true), '/../2-providing-input/template-with-params.php');
