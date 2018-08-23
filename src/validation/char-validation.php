<?php
function charValidation($char_test){
    return htmlspecialchars($char_test) && preg_quote($char_test);
}
