<?php

/* @var $scripts array */

use yii\bootstrap\Html;

?>
<h2 class="h22">Added requests</h2>

<table border="2" class="table table-striped">
    <tr>
        <th>ID</th>
        <th>Sql script</th>
    </tr>
    <?php
    foreach ($scripts as $item) {
        echo "
                <tr>
                    <td>{$item->id}</td>
                    <td>{$item->sql_script}</td>
                </tr>
            ";
    }
    ?>
</table>


