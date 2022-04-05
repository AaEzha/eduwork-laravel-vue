<?php

namespace GroceryCrud\Core\Upload;

use GroceryCrud\Core\Helpers\UploadHelper;

class MultipleUpload
{
    /********************************************************************************
     * Static Properties
     *******************************************************************************/

    /**
     * Upload error code messages
     * @var array
     */
    protected static $errorCodeMessages = array(
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk',
        8 => 'A PHP extension stopped the file upload'
    );

    /**
     * Lookup hash to convert file units to bytes
     * @var array
     */
    protected static $units = array(
        'b' => 1,
        'k' => 1024,
        'm' => 1048576,
        'g' => 1073741824
    );

    /**
     * @var array|mixed
     */
    protected $_filesRaw = [];

    /**
     * @var array
     */
    protected $_allowedFileTypes = [];

    /**
     * @var int
     */
    protected $_maxUploadSize;

    /**
     * @var int
     */
    protected $_minUploadSize;

    /**
     * @var array
     */
    protected $_errorMessages = [];

    /**
     * @var string
     */
    protected $_uploadPath;

    protected $_uploadedFiles = [];

    /**
     * @param string $key
     */
    public function __construct($key, $uploadPath)
    {
        if (!isset($_FILES[$key])) {
            throw new \InvalidArgumentException("Cannot find uploaded file identified by key: $key");
        }

        $this->_uploadPath = $uploadPath;

        $this->_filesRaw = $_FILES[$key];
    }

    /**
     * Is this file has Upload Errors?
     *
     * This method inspects the upload error code to see if the upload was
     * successful or if it failed for any reason.
     *
     * @link    http://www.php.net/manual/en/features.file-upload.errors.php
     * @param int $errorCode
     * @return  bool
     */
    public function doesThisFileHasErrors(int $errorCode): bool
    {
        return ($errorCode !== UPLOAD_ERR_OK);
    }


    public function validExtension(string $fileName): bool
    {
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        return in_array($fileExtension, $this->_allowedFileTypes);
    }

    public function validMaxSize(int $fileSize): bool
    {
        return ($fileSize <= $this->_maxUploadSize);
    }

    public function validMinSize(int $fileSize): bool
    {
        return ($fileSize >= $this->_minUploadSize);
    }

    public function getUploadedFilesInfo() {
        return $this->_filesRaw;
    }

    /**
     * @param array $allowedFileTypes
     * @return $this
     */
    public function setValidationAllowedExtensions(array $allowedFileTypes): MultipleUpload
    {
        $this->_allowedFileTypes = $allowedFileTypes;

        return $this;
    }

    /**
     * @param string $maxUploadSize
     * @return $this
     */
    public function setValidationMaxUploadSize(string $maxUploadSize): MultipleUpload
    {
        $this->_maxUploadSize = $this->humanReadableToBytes($maxUploadSize);

        return $this;
    }

    /**
     * @param string $minUploadSize
     * @return $this
     */
    public function setValidationMinUploadSize(string $minUploadSize): MultipleUpload
    {
        $this->_minUploadSize = $this->humanReadableToBytes($minUploadSize);

        return $this;
    }

    /**
     * Convert human readable file size (e.g. "10K" or "3M") into bytes
     * @param  string $input
     * @return int
     */
    public static function humanReadableToBytes(string $input): int
    {
        $number = (int)$input;
        $unit = strtolower(substr($input, -1));
        if (isset(self::$units[$unit])) {
            $number = $number * self::$units[$unit];
        }

        return $number;
    }

    /**
     * @param string $uploadPath
     * @return $this
     */
    public function setUploadPath(string $uploadPath): MultipleUpload
    {
        $this->_uploadPath = $uploadPath;

        return $this;
    }

    /**
     * Basic Check to check if the data that we are about to check are correct. This is very rare to have
     * an error here as these are coming from the PHP itself.
     *
     * @return bool
     */
    protected function validateUploadData(): bool
    {
        $uploadedFilesInfo = $this->getUploadedFilesInfo();

        if (
            !isset($uploadedFilesInfo['error']) ||
            !isset($uploadedFilesInfo['name']) ||
            !isset($uploadedFilesInfo['type']) ||
            !isset($uploadedFilesInfo['tmp_name']
        )) {
            return false;
        }

        if (
            !is_array($uploadedFilesInfo['error']) ||
            !is_array($uploadedFilesInfo['name']) ||
            !is_array($uploadedFilesInfo['type']) ||
            !is_array($uploadedFilesInfo['tmp_name']
        )) {
            return false;
        }

        return true;
    }

    /**
     * Is this file uploaded with a POST request?
     *
     * @param string $pathName
     * @return bool
     */
    public function isUploadedFile(string $pathName): bool
    {
        return is_uploaded_file($pathName);
    }

    /**
     * Validate upload data
     *
     * @return bool
     */
    public function validate(): bool
    {
        if ($this->validateUploadData() === false) {
            // Very rare scenario and hence throwing a generic error
            throw new \InvalidArgumentException("We don't have the correct data in order to upload");
        }

        $errorMessages = [];
        $onlyOneErrorMessagesForFiles = [];

        $filesInfo = $this->getUploadedFilesInfo();

        // Check for Errors from the system
        foreach ($filesInfo['error'] as $numRow => $errorCode) {
            if (in_array($filesInfo['name'][$numRow], $onlyOneErrorMessagesForFiles)) {
                continue;
            }
            if ($this->doesThisFileHasErrors($errorCode)) {
                $errorMessages[] = 'File "' . $filesInfo['name'][$numRow] . '": ' . self::$errorCodeMessages[$errorCode];
                $onlyOneErrorMessagesForFiles[] = $filesInfo['name'][$numRow];
            }
        }

        // Check allowed file types
        foreach ($filesInfo['name'] as $numRow => $fileName) {
            if (in_array($filesInfo['name'][$numRow], $onlyOneErrorMessagesForFiles)) {
                continue;
            }
            if (!$this->validExtension($fileName)) {
                $errorMessages[] = 'File "' . $filesInfo['name'][$numRow] . '": Invalid file extension. Must be one of: ' . implode(', ', $this->_allowedFileTypes);
                $onlyOneErrorMessagesForFiles[] = $filesInfo['name'][$numRow];
            }
        }

        // Check file size
        foreach ($filesInfo['size'] as $numRow => $fileSize) {

            if (in_array($filesInfo['name'][$numRow], $onlyOneErrorMessagesForFiles)) {
                continue;
            }

            if (!$this->validMaxSize($fileSize)) {
                $errorMessages[] = 'File "' . $filesInfo['name'][$numRow] . '": File size is too large.';
                $onlyOneErrorMessagesForFiles[] = $filesInfo['name'][$numRow];
            }

            if (!$this->validMinSize($fileSize)) {
                $errorMessages[] = 'File "' . $filesInfo['name'][$numRow] . '": File size is too small.';
                $onlyOneErrorMessagesForFiles[] = $filesInfo['name'][$numRow];
            }
        }

        // Upload path destination checks
        if (!is_dir($this->_uploadPath)) {
            $errorMessages[] = "The upload directory specified does not exist";
        } else if (!is_writable($this->_uploadPath)) {
            $errorMessages[] = "The upload directory specified is not writable";
        }

        $this->_errorMessages = $errorMessages;

        return empty($errorMessages);
    }

    public function getValidationErrors() {
        return $this->_errorMessages;
    }

    /**
     * Upload is not basically uploading the file as PHP has already uploaded the file if the validate()
     * function has been passed. Upload will basically move the temporary uploaded file into our desired
     * path destination
     *
     * @return bool
     */
    public function upload(): bool
    {
        $filesInfo = $this->getUploadedFilesInfo();

        foreach ($filesInfo['name'] as $numRow => $fileName) {
            $fileExtension = UploadHelper::getExtension($fileName);
            $newFileName = UploadHelper::transformRawFilename(UploadHelper::removeExtension($fileName));

            if (file_exists($this->_uploadPath . '/' . $newFileName . '.' . $fileExtension)) {
                $newFileName = $newFileName . '-' .substr(uniqid(), -5);
            }

            $newFileName .= '.' . $fileExtension;

            move_uploaded_file($filesInfo['tmp_name'][$numRow], "{$this->_uploadPath}/$newFileName");

            $this->_uploadedFiles[] = $newFileName;
        }

        return true;
    }

    /**
     * @return array
     */
    public function getUploadedFiles():array {
        return $this->_uploadedFiles;
    }

    /**
     * @return string
     */
    public function getUploadPath():string {
        return $this->_uploadPath;
    }

}