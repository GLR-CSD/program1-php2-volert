<?php
global $Nummer;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albumlijst</title>
    <link rel="stylesheet" href="public/css/simple.css">
</head>
<body>
<h1>Albumlijst</h1>
<table>
    <tr>
        <th>ID</th>
        <th>AlbumID</th>
        <th>Title</th>
        <th>Duur</th>
        <th>URL</th>
    </tr>
    <?php foreach ($Nummer as $nummer): ?>
        <tr>
            <td><?= $nummer->getID() ?></td>
            <td><?= $nummer->getAlbumID() ?></td>
            <td><?= $nummer->getTitle() ?></td>
            <td><?= $nummer->getDuur() ?></td>
            <td><?= $nummer->getURL() ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="notice">
    <h2>Album Toevoegen:</h2>
    <?php if (!empty($errors)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="toevoegen.php" method="post">
        <label for="AlbumID">AlbumID:</label>
        <input type="text" id="AlbumID" name="AlbumID" value="<?= $formValues['AlbumID'] ?? '' ?>" required>
        <?php if (isset($errors['AlbumID'])): ?>
            <span style="color: red;"><?= $errors['AlbumID'] ?></span>
        <?php endif; ?><br>
        <label for="Title">Title:</label>
        <input type="text" id="Title" name="Title" value="<?= $formValues['Title'] ?? '' ?>" required>
        <?php if (isset($errors['Title'])): ?>
            <span style="color: red;"><?= $errors['Title'] ?></span>
        <?php endif; ?><br>
        <label for="Duur">Duur:</label>
        <input type="text" id="Duur" name="Duur" value="<?= $formValues['Duur'] ?? '' ?>">
        <?php if (isset($errors['Duur'])): ?>
            <span style="color: red;"><?= $errors['Duur'] ?></span>
        <?php endif; ?><br>
        <label for="URL">URL:</label>
        <input type="url" id="URL" name="URL" value="<?= $formValues['URL'] ?? '' ?>">
        <?php if (isset($errors['URL'])): ?>
            <span style="color: red;"><?= $errors['URL'] ?></span>
        <?php endif; ?><br>
        <input type="submit" value="Toevoegen">
    </form>
</div>
</body>
</html>
