<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Error\ErrorMessage;
use GroceryCrud\Core\Upload\MultipleUpload;

class UploadMultipleState extends StateAbstract {

    const DEFAULT_MAX_UPLOAD_SIZE = '20M';
    const DEFAULT_MIN_UPLOAD_SIZE = '1B';

    public function getStateParameters()
    {
        if (empty($_FILES)) {
            // No files to upload? Then we need to get away as quickly as possible
            throw new \ErrorException('There are no data for upload. There is probably a system error or warning already shown above');
        }

        return (object)[
            'field_name' => array_keys($_FILES)[0]
        ];
    }

    /**
     * $maxUploadSize: Ensure file is no larger than maxUploadSize (use "B", "K", M", or "G")
     *
     * @param string $fieldName
     * @param string $uploadPath
     * @param string $maxUploadSize
     * @param string $minUploadSize
     * @param array $allowedFileTypes
     * @return bool|object
     */
    public function uploadMultiple(string $fieldName, string $uploadPath, string $maxUploadSize, string $minUploadSize, array $allowedFileTypes)
    {
        $uploader = new MultipleUpload($fieldName, $uploadPath);

        $uploader->setValidationAllowedExtensions($allowedFileTypes);
        $uploader->setValidationMaxUploadSize($maxUploadSize);
        $uploader->setValidationMinUploadSize($minUploadSize);

        if ($uploader->validate() === true) {
            $uploader->upload();
        } else {
            $errors = "- " . implode("\n -", $uploader->getValidationErrors());
            return (new ErrorMessage())->setMessage("There were some validation errors with the upload:\n" . $errors);
        }

        return (object)[
            'uploadedFiles' => $uploader->getUploadedFiles()
        ];
    }

    public function render()
    {
        $stateParameters = $this->getStateParameters();

        $this->setModel();
        $model = $this->gCrud->getModel();

        $this->initializeLight($model);

        $response = $this->stateOperationWithCallbacks($stateParameters, 'Upload', function ($stateParameters) {
            $field_name = $stateParameters->field_name;
            $field_types = $this->getFieldTypes();

            $globalAllowedFileTypes = $this->getGlobalAllowedFileTypes();

            if (isset($field_types[$field_name]) && $field_types[$field_name]->dataType === GroceryCrud::FIELD_TYPE_UPLOAD_MULTIPLE) {
                $maxUploadSize = array_key_exists('maxUploadSize', $field_types[$field_name]->options->extraOptions)
                    ? $field_types[$field_name]->options->extraOptions['maxUploadSize']:
                    UploadState::DEFAULT_MAX_UPLOAD_SIZE;

                $minUploadSize = array_key_exists('minUploadSize', $field_types[$field_name]->options->extraOptions)
                    ? $field_types[$field_name]->options->extraOptions['minUploadSize']:
                    UploadState::DEFAULT_MIN_UPLOAD_SIZE;

                $allowedFileTypes = array_key_exists('allowedFileTypes', $field_types[$field_name]->options->extraOptions)
                    ? $field_types[$field_name]->options->extraOptions['allowedFileTypes']:
                    $globalAllowedFileTypes;

                $uploadPath = $field_types[$field_name]->options->uploadPath;

                $response = $this->uploadMultiple($field_name, $uploadPath, $maxUploadSize, $minUploadSize, $allowedFileTypes);
            } else {
                $response = (new ErrorMessage())->setMessage('This operation is not allowed');
            }

            return $response;
        });

        $output = (object)array();
        $output = $this->setResponseStatusAndMessage($output, $response);

        if (!$this->hasErrorResponse($response)) {
            $output->uploadResult = $response;
        }

        $output = $this->addcsrfToken($output);

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;

    }
}