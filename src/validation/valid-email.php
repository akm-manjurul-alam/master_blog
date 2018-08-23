<?php
/*
 * Prüfe. ob die eingegebene Emailadresse valide ist
 */
function validEmail($emailadresse){
   return filter_var($emailadresse,FILTER_VALIDATE_EMAIL);
}


