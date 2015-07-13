<form enctype="multipart/form-data" action="" method="post">
    <input type="text" name="name" />
    <br />
    <input type="file" name="pliczek" />
    <br />
    <textarea name="opis"></textarea>

    <br />
    <select name="model">
        <option value="audi">Audi</option>
        <option value="opel">Opel</option>
        <option value="Toyota">Toyota</option>
        <option value="Honda">Honda</option>
    </select>
    <br />

    <select name="category">
        <?php
        var_dump($marki);
        foreach($marki as $row) {
            echo '<option value="'.$row['cat_id'].'">'.$row['cat_name'].'</option>';

        }
        ?>
    </select>

    <br />

    <input type="submit" value="zapisz">
</form>