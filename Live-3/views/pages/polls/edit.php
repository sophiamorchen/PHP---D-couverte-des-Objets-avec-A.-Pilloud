<form action="" method="post">
    <div>
        <label for="title">Titre</label>
        <input type="text" name="title" value="<?php echo $data['poll']->title; ?>">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" cols="30" rows="10"><?php echo $data['poll']->description; ?></textarea>
    </div>
    <div>
        <button type="submit">Ajouter</button>
    </div>
</form>


