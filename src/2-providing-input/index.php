<?php

$v8 = new V8Js("PHPJS");

$javascriptWrapper = "PHPJS.output.result = function() { %s
}();";

require_once 'params.php';
$params = new Params($_POST);
$v8->Params = $params;

$javascriptCode = <<<EOJS
var input = {
    name : PHPJS.Params.getName(),
    score : PHPJS.Params.getScore()
};

return input;
EOJS;

try {
    $v8->output = new stdClass();
    $v8->executeString(sprintf($javascriptWrapper, $javascriptCode), 'example-2', V8Js::FLAG_FORCE_ARRAY);
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

$phpCode = '
class Params {
    private $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function getName() {
        return $this->data["name";
    }
}

$v8 = new V8Js("PHPJS");
$javascriptWrapper = "PHPJS.output.result = function() { %s }();";
$v8->output = new stdClass();

$v8->Params = new Params($_POST);

$v8->executeString(sprintf($javascriptWrapper, $javascriptCode));
return $v8->output->result;
';

require dirname(__FILE__) . '/../helpers/view.php';
View::render($phpCode, $javascriptCode, var_export($returned, true), '/../2-providing-input/template-with-params.php');
