<?php

/* @var $sysTable array */

use yii\bootstrap\Html;

?>
<h2 class="h22">All Tables</h2>
<br>
<table border="2" class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Name of table</th>
        <th>Description/Title</th>
    </tr>

    <?php
    foreach ($sysTable as $item) {
        echo "
                <tr>
                    <td>{$item->id}</td>
                    <td>{$item->table_name}</td>
                    <td>{$item->title}<a href='/record/current-table?name={$item->table_name}'><button class='list_button'>-></button></a></td>
                </tr>
            ";
    }
    ?>
</table>