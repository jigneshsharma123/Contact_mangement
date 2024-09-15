<?php

namespace JigneshSharma\New\Form;

class CheckboxField extends Field {

    public function render() {
        $checked = $this->value ? 'checked' : '';
        return "<label for='{$this->name}'>{$this->label}</label>
                <input type='checkbox' name='{$this->name}' {$checked} />";
    }
}
