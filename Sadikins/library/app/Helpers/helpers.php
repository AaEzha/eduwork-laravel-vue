<?php
function convert_date($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}
