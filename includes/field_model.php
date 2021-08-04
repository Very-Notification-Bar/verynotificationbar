<?php

function text_model(String $type, String $classe, String $name, String $val)
{
    return <<<HTML
    <div>
    <input type="{$type}" class="{$classe}" name="{$name}" value="{$val}" />
    </div>
HTML;
}

function number_model(String $type, String $name, String $val)
{
    return <<<HTML
    <div>
    <input type="{$type}"  name="{$name}" value="{$val}" />
    </div>
HTML;
}

function select_model(String $name)
{
    require("notification_bar_fonts.php");
    
    foreach ($tab_font as $val) {
        echo "<option value='".$val."' ".selected($name, $val)." >".$val."</option>";
    }
}