<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud;
use GroceryCrud\Core\Render\RenderAbstract;

class InitialState extends StateAbstract implements StateInterface
{
    public function render()
    {
        $this->setInitialData();

        $output = $this->showInitData();

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;
    }

    public function showInitData()
    {
        $data = (object)[];
        $config = $this->gCrud->getConfig();

        $data->i18n = $this->getI18n();
        $data->subject = (object) [
            'subject_single' => $this->gCrud->getSubject() !== null ? $this->gCrud->getSubject() : '',
            'subject_plural' => $this->gCrud->getSubjectPlural() !== null ? $this->gCrud->getSubjectPlural() : ''
        ];

        $actionButtons = $this->gCrud->getActionButtons();
        $actionButtonsMultiple = $this->gCrud->getActionButtonsMultiple();

        $operations = (object) array(
            'add' => $this->gCrud->getLoadAdd(),
            'edit' => $this->gCrud->getLoadEdit(),
            'read' => $this->gCrud->getLoadRead(),
            'deleteSingle' => $this->gCrud->getLoadDelete(),
            'deleteMultiple' => $this->gCrud->getLoadDeleteMultiple(),
            'exportData' => $this->gCrud->getLoadExport(),
            'exportPdf' => $this->gCrud->getLoadExportPdf(),
            'exportExcel' => $this->gCrud->getLoadExportExcel(),
            'print' => $this->gCrud->getLoadPrint(),
            'clone' => $this->gCrud->getLoadClone(),
            'actionButtons' => !empty($actionButtons),
            'actionButtonsMultiple' => !empty($actionButtonsMultiple),
            'settings' => $this->gCrud->getLoadSettings(),
            'filters' => $this->gCrud->getLoadFilters()
        );

        $data->columns = $this->transformFieldsList($this->gCrud->getColumns(), $this->gCrud->getUnsetColumns());
        $data->addFields = $this->getAddFields();
        $data->editFields = $this->getEditFields();
        $data->cloneFields = $this->getCloneFields();
        $data->readFields = $this->transformFieldsList($this->gCrud->getReadFields(), $this->gCrud->getUnsetReadFields());
        $data->readOnlyAddFields = $this->gCrud->getReadOnlyAddFields();
        $data->readOnlyEditFields = $this->gCrud->getReadOnlyEditFields();
        $data->readOnlyCloneFields = $this->gCrud->getReadOnlyCloneFields();

        $data->paging = (object)[
            'defaultPerPage' => $config['default_per_page'],
            'pagingOptions'  => $config['paging_options']
        ];
        $data->config = (object)[
            'skin' => $this->getSkin(),
            'dateFormat' => $this->getDateFormat()
        ];
        $data->primaryKeyField = $this->getPrimaryKeyField();
        $data->fieldTypes = $this->filterTypesPrivateInfo($this->getFieldTypes());
        $data->fieldTypesAddForm = $this->filterTypesPrivateInfo($this->getFieldTypesAddForm());
        $data->fieldTypesEditForm = $this->filterTypesPrivateInfo($this->getFieldTypesEditForm());
        $data->fieldTypesReadForm = $this->filterTypesPrivateInfo($this->getFieldTypesReadForm());
        $data->fieldTypesCloneForm = $this->filterTypesPrivateInfo($this->getFieldTypesCloneForm());
        $data->fieldTypesColumns = $this->filterTypesPrivateInfo($this->getFieldTypeColumns());
        $data->operations = $operations;
        $data->extraConfiguration = $this->extraConfigurations();

        $data->actionButtonsMultiple = $actionButtonsMultiple;

        $data = $this->addcsrfToken($data);

        return $data;
    }

    public function extraConfigurations() {
        $data = (object)[];

        $config = $this->gCrud->getConfig();

        $hasTextEditor = count($this->gCrud->getTextEditorFields()) > 0;

        if ($hasTextEditor) {
            $data->textEditorType =
                array_key_exists('text_editor_type', $config) ? $config['text_editor_type'] : 'full';
        }

        if (array_key_exists('hash_in_url', $config)) {
            $data->hashInUrl = $config['hash_in_url'];
        }

        if (array_key_exists('action_button_type', $config)) {
            $data->actionButtonType = $config['action_button_type'];
        }

        if (array_key_exists('open_in_modal', $config)) {
            $data->openInModal = $config['open_in_modal'];
        }

        if (array_key_exists('actions_column_side', $config) && in_array($config['actions_column_side'], ['left', 'right'])) {
            $data->leftSideActions = $config['actions_column_side'] === 'left';
            $data->rightSideActions = $config['actions_column_side'] === 'right';
        } else {
            $data->leftSideActions = true;
            $data->rightSideActions = false;
        }

        $data->rememberQuickSearch = array_key_exists('remember_quick_search', $config)
            ? $config['remember_quick_search']
            : false;

        $data->maxActionButtons = (object)[
            'mobile' =>
                array_key_exists('max_action_buttons', $config) && array_key_exists('mobile', $config['max_action_buttons'])
                    ? $config['max_action_buttons']['mobile']
                    : 1,
            'desktop' =>
                array_key_exists('max_action_buttons', $config) && array_key_exists('desktop', $config['max_action_buttons'])
                    ? $config['max_action_buttons']['desktop']
                    : 2,
        ];

        return $data;
    }

    public function filterTypesPrivateInfo($fieldTypes) {
        foreach ($fieldTypes as &$fieldType) {
            if ($fieldType->dataType === GroceryCrud::FIELD_TYPE_UPLOAD) {
                unset($fieldType->options->uploadPath);
            }
            if ($fieldType->dataType === GroceryCrud::FIELD_TYPE_BLOB) {
                $fieldType->options = null;
            }
        }

        return $fieldTypes;
    }

    public function getPrimaryKeyField() {
        return $this->gCrud->getModel()->getPrimaryKeyField();
    }
}