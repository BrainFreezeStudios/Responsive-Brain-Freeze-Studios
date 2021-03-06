<?php

function multi_implode($array, $glue) {
    $ret = '';

    foreach ($array as $item) {
        if (is_array($item)) {
            $ret .= multi_implode($item, $glue) . $glue;
        } else {
            $ret .= $item . $glue;
        }
    }
    $ret = substr($ret, 0, 0 - strlen($glue));
    return $ret;
}

function trim_value(&$value) {
    $value = trim($value);
}
?>
