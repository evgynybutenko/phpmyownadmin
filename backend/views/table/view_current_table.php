<?php
/* @var $columns array */
/* @var $name string */

$attributes = array_keys($columns[0]->getAttributes());
//var_dump($columns[0]->id);die;
?>

<h2 class="h22">Table: <?= $name?></h2>

<table border="2" class="table table-striped">
    <tr>
    <?php
        foreach ($attributes as $attribute) {
            echo "
                <th>{$attribute}</th>
            ";
        }
    ?>
    </tr>

<?php
    foreach ($columns as $item)
    {
        echo "<tr>";

        foreach ($attributes as $attribute)
        {
            echo "<td>{$item->$attribute}</td>";
        }

        echo "</tr>";





    }
?>
</table>
