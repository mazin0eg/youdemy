<?php
class TEXT {
    static $r= 0;
    static function increament(){
    self::$r++;
    }
}
TEXT::increament();

echo TEXT::$r;
?>
