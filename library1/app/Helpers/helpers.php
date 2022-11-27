<?php 

    function dateFormat($value){
        return date(' d M Y', strtotime($value));
    }

?>