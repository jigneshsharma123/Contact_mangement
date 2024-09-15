<?php

namespace JigneshSharma\New\Form;

class Form {
    private $fields = [];

    public function __construct($fieldConfigs) {
        foreach ($fieldConfigs as $config) {
            $className = "JigneshSharma\\New\\Form\\" . ucfirst($config['type']) . "Field";
            if (class_exists($className)) {
                $this->fields[] = new $className($config['name'], $config['label'], $config['value'] ?? '');
            }
        }
    }

    public function render() {
        $html = '<form>';
        foreach ($this->fields as $field) {
            $html .= $field->render() . '<br>';
        }
        $html .= '<button type="submit">Submit</button></form>';
        return $html;
    }
}
