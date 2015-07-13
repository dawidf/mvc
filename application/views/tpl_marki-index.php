<table border="1">
    <tr><th>Marka</th><th>Options</th></tr>
    <?php foreach($marki as $marka): ?>
        <tr>
            <td><?php echo $marka['cat_name'] ?></td>
            <td>
                <a href="<?php echo Url::getUrl( 'marki', 'deleteMarke', array ( 'id' => $marka[ 'cat_id' ] ) ) ?> "> Usuń
                </a>
            </td>
        </tr>


    <?php endforeach; ?>

</table>
