<?php
// config/grocerycrud.php

return [
    // So far 34 languages including: Afrikaans, Arabic, Bengali, Bulgarian, Catalan, Chinese, Czech, Danish,
    // Dutch, English, French, German, Greek, Hindi, Hungarian, Indonesian, Italian, Japanese, Korean,
    // Lithuanian, Mongolian, Norwegian, Persian, Polish, Portuguese, Brazilian Portuguese, Romanian,
    // Russian, Slovak, Spanish, Thai, Turkish, Ukrainian, Vietnamese
    'default_language'  => 'English',

    // This is the assets folder where all the JavaScript, CSS, images and font files are located
    'assets_folder' => env('APP_URL') . '/assets/grocery-crud/',

    // There are only three choices: "uk-date" (dd/mm/yyyy), "us-date" (mm/dd/yyyy) or "sql-date" (yyyy-mm-dd)
    'date_format' => 'uk-date',

    // The default per page when a user firstly see a list page
    'default_per_page'  => 10,

    // Having some options at the list paging. This is the default one that all the websites are using.
    // Make sure that the number of grocery_crud_default_per_page variable is included to this array.
    'paging_options' => ['10', '25', '50', '100'],

    // The environment is important so we can have specific configurations for specific environments
    'environment' => 'development',

    // Currently you can choose between 'bootstrap-v3', 'bootstrap-v4' and 'bootstrap-v5'
    'skin' => 'bootstrap-v5',

    // Automatically cleans all the inputs by trimming strings and by completely removing any HTML tag
    // to prevent XSS attacks. This is a global configuration for all the inputs so be aware in case you
    // switch this to true
    'xss_clean' => false,

    // The character limiter at the datagrid columns, zero(0) value if you don't want any character
    // limitation to the column
    'column_character_limiter' => 50,

    // Configuration for the texteditor. You can choose between 'minimal' or 'full'
    'text_editor_type' => 'full',

    // The allowed file types on upload. If the file extension doesn't exist in the array
    // it will throw an error and the upload will not be completed
    'upload_allowed_file_types' =>  [
        'gif', 'jpeg', 'jpg', 'png', 'svg', 'tiff', 'doc', 'docx',  'rtf', 'txt', 'odt', 'xls', 'xlsx', 'pdf',
        'ppt', 'pptx', 'pps', 'ppsx', 'mp3', 'm4a', 'ogg', 'wav', 'mp4', 'm4v', 'mov', 'wmv', 'flv', 'avi',
        'mpg', 'ogv', '3gp', '3g2'
    ],

    // If open_in_modal is true then all the form operations (e.g. add, edit, clone... e.t.c.) will
    // open within a modal and we will have the datagrid on the background.
    // In case you would like however to have a standalone page for all the form operations change this to false.
    'open_in_modal' => true,

    // This is the hash symbol (#) that we have at the URL in order to have tha basic operations in the URL so you
    // can navigate back to the URL that you were. For example, when you click at edit form for the id 46, the
    // URL will also change to #/edit/46 so you can also share the link.
    // In case you would like to switch this functionality to off change this to false.
    'hash_in_url' => true,

    // The button style that we have for the action buttons at the datagrid (list) page
    // Choose between 'icon', 'text', 'icon-text'
    'action_button_type' => 'icon-text',

    // The maximum number of buttons that we would like to have for the actions buttons.
    // If the number of buttons exceeds this number then the last button on the right
    // is going to change into a "More" dropdown button.
    // If the maximum number is 1 then as we only have one button as a dropdown list the translation
    // is "Actions" rather than "More"
    'max_action_buttons' => [
        'mobile' => 1,
        'desktop' => 2
    ],

    // Choose between 'left' or 'right'
    'actions_column_side' => 'left',

    // We have noticed that especially after using setRelation within a table that had more than 10K rows
    // that the datagrid was getting slower. For that reason we have optimized SQL wherever possible, and we
    // also have disabled the ordering for setRelation fields.  Keep in mind that the optimization of the queries
    // can be up to 20x faster!! Especially in big tables (e.g. with 1 million rows).
    // In case you would like though to use the ordering for the setRelation field, and you don't have big tables
    // you can set this to `false` and you will probably not notice any difference
    'optimize_sql_queries' => true,

    // Remember the quick search upon refresh. The search information is stored in the browser local storage
    'remember_quick_search' => false,
];
