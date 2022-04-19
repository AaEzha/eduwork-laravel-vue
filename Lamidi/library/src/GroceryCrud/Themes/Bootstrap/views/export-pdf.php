<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $subjectPlural; ?></title>
</head>
<body>
<style type="text/css">
    html {
        padding: 0;
        margin: 0;
    }
    body {
        font-family: Arial;
        padding: 0 5px;
        margin: 0;
    }
    table {
        width: 100%;
        border: none;
        border-left: 1px solid #333;
        border-bottom: 1px solid #333;
    }

    table td, table th {
        border: 1px solid #333;
        border-left: none;
        border-bottom: none;
        padding: 0.5rem;
    }
    table th {
        text-align: left;
    }
    h1 {
        text-align: center;
        padding: 5px 0;
        width: 100%;
        display: block;
        font-size: 1rem;
    }
    table.pdf-table {
        display: none;
    }
    .pdf-fullpage {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 2;
        border: none;
    }
</style>
<h1><?php echo $i18n->loading; ?></h1>
<table cellspacing="0" id="gc-pdf-table" class="pdf-table">
    <thead>
    <tr>
        <?php foreach ($columns as $column) { ?>
            <th><?php echo $column->displayAs; ?></th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($data as $row) { ?>
        <tr>
            <?php foreach ($columns as $column) {
                $fieldName = $column->name;
                if (!empty($row[$fieldName]) && is_string($row[$fieldName])) {
                    ?><td><?php echo $row[$fieldName]; ?></td><?php
                } else if (is_array($row[$fieldName])) {
                    ?><td><?php echo implode(', ', $row[$fieldName]); ?></td><?php
                } else {
                    ?><td>&nbsp;</td><?php
                }
            } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>
<iframe id="main-iframe" class="pdf-fullpage" style=""></iframe>
<script src="<?php echo $this->_assetsFolder;?>js/libraries/jspdf/jspdf.min.js"></script>
<script src="<?php echo $this->_assetsFolder;?>js/libraries/jspdf/Roboto-Regular-normal.js"></script>
<script src="<?php echo $this->_assetsFolder;?>js/libraries/jspdf/jspdf.plugin.autotable.js"></script>
<script>
    var doc = new jsPDF();

    doc.autoTable({
        headStyles: {
            fillColor: '#ffffff',
            textColor: '#111111',
            font: 'Roboto-Regular'
        },
        bodyStyles: {
            font: 'Roboto-Regular'
        },
        html: '#gc-pdf-table'
    });
    doc.save('<?php echo $filename; ?>.pdf');
    document.getElementById('main-iframe').setAttribute('src', doc.output('bloburl'));
</script>
</body>
</html>