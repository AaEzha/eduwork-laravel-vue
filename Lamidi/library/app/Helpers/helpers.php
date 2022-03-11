<?php
function format_date($value)
{
    return date('H:i:s - d M Y', strtotime($value));
}
