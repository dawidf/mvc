<form enctype="multipart/form-data" action="" method="post">
    <input type="text" name="name" value="<?php echo $car['car_name'] ?>"/>
    <br />
    <img src="<?php echo $dirImgMin.$car['car_image'] ?>" alt=""/>
    <input type="file" name="pliczek" />
    <input type="hidden" name="imageName" value="<?php echo $car['car_image'] ?>"/>
    <br />
    <textarea name="opis"><?php echo $car['car_description'] ?></textarea>

    <br />
    <select name="model">
        <?php echo '<option value="'.$car['car_model'].'" selected>'.$car['car_model'].'</option>' ?>
        <option value="audi">Audi</option>
        <option value="opel">Opel</option>
        <option value="Toyota">Toyota</option>
        <option value="Honda">Honda</option>
    </select>
    <br />

    <select name="category">
        <?php

        foreach($marki as $row) {
            echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';

        }
        ?>
    </select>
    <input type="hidden" name="carId" value="<?php echo $car['car_id'] ?>"/>


    <br />

    <input type="submit" value="zapisz">
</form>