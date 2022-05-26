<?php 

    function dateFormat($value){
        return date(' D, d M Y', strtotime($value));
    }

?>