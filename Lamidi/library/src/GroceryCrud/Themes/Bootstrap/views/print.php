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
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
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
</style>
<h1><?php echo $subjectPlural; ?></h1>
<table cellspacing="0">
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
<script>
    window.print();
    window.onfocus = function () { setTimeout(function () { window.close(); }, 500); }
</script>
</body>
</html>