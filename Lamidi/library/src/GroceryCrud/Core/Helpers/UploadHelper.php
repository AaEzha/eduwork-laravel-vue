<?php namespace GroceryCrud\Core\Helpers;

use GroceryCrud\Core\Upload\Transliteration;

class UploadHelper
{
    public static function transformRawFilename(string $filename) {
        // Filter any non existance characters. Filter XSS vulnerability
        // Also trim multiple whitespaces in a row
        $filename = trim(filter_var($filename));

        // Covert Translite characters
        $filename = Transliteration::convertFilename($filename);

        // Replace dot and empty space with dash
        $filename = str_replace(['.', ' '], '-', $filename);

        // Completely remove any illegal characters
        $filename = preg_replace("/([^a-zA-Z0-9\-\_ ]+?){1}/i", '', $filename);

        // A final check that we haven't ended up with an empty string!
        if (empty($filename)) {
            $filename = substr(uniqid(), -5);
        }

        return $filename;
    }

    public static function removeExtension(string $filename) {
        return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
    }

    public static function getExtension(string $filename) {
        $splittedFilename = explode('.', strtolower($filename));
        return end($splittedFilename);
    }
}