<?php

/* @var $sysTable array */

use yii\bootstrap\Html;

?>
<h2 class="h22">All Tables</h2>

<table border="2" class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Name of table</th>
        <th>Title</th>
    </tr>

    <?php
    foreach ($sysTable as $item) {
        echo "
                <tr>
                    <td>{$item->id}</td>
                    <td>{$item->table_name}</td>
                    <td>{$item->title}</td>
                </tr>
            ";
    }
    ?>
</table>