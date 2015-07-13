<table border="1">
    <tr><th>Kategoria</th><th>id</th><th>Model</th><th>image</th><th>Opis</th><th>Name</th><th></th></tr>
    <?php foreach($data as $car): ?>
        <tr>
            <td><?php echo $car['cat_name'] ?></td>
            <td><?php echo $car['car_id'] ?></td>

            <td><?php echo $car['car_model'] ?></td>
            <td><?php if(!$car['car_image'] == ''){ echo '<img src="'.$dirImgMin.$car['car_image'] .'">'; } ?></td>
            <td><?php echo $car['car_description'] ?></td>
            <td><?php echo $car['car_name'] ?></td>
            <td>
                <a href="<?php echo Url::getUrl( 'cars', 'editCar', array ( 'id' => $car[ 'car_id' ] ) ) ?> ">Edytuj</a>
                <a href="<?php echo Url::getUrl( 'cars', 'deleteCar', array ( 'id' => $car[ 'car_id' ] ) ) ?> ">Delete</a>
            </td>
        </tr>


    <?php endforeach; ?>

</table>

<?php $partial->display('pager'); ?>

