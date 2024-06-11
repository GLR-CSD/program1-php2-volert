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
        <th>Naam</th>
        <th>Artiesten</th>
        <th>Release Datum</th>
        <th>URL</th>
        <th>Afbeeldingen</th>
        <th>Prijs</th>
    </tr>
    <?php foreach ($albums as $album): ?>
        <tr>
            <td><?= $album->getId() ?></td>
            <td><?= $album->getNaam() ?></td>
            <td><?= $album->getArtiesten() ?></td>
            <td><?= $album->getRelease_Datum() ?></td>
            <td><?= $album->getURL() ?></td>
            <td><img src="/images/<?= $album->getAfbeeldingen() ?> "> </td>
            <td><?= $album->getPrijs() ?></td>
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
        <label for="Naam">Naam:</label>
        <input type="text" id="Naam" name="Naam" value="<?= $formValues['Naam'] ?? '' ?>" required>
        <?php if (isset($errors['Naam'])): ?>
            <span style="color: red;"><?= $errors['Naam'] ?></span>
        <?php endif; ?><br>
        <label for="Artiesten">Artiesten:</label>
        <input type="text" id="Artiesten" name="Artiesten" value="<?= $formValues['Artiesten'] ?? '' ?>" required>
        <?php if (isset($errors['Artiesten'])): ?>
            <span style="color: red;"><?= $errors['Artiesten'] ?></span>
        <?php endif; ?><br>
        <label for="Release_Datum">Release Datum:</label>
        <input type="date" id="Release_Datum" name="Release_Datum" value="<?= $formValues['Release_Datum'] ?? '' ?>">
        <?php if (isset($errors['Release_Datum'])): ?>
            <span style="color: red;"><?= $errors['Release_Datum'] ?></span>
        <?php endif; ?><br>
        <label for="URL">URL:</label>
        <input type="url" id="URL" name="URL" value="<?= $formValues['URL'] ?? '' ?>">
        <?php if (isset($errors['URL'])): ?>
            <span style="color: red;"><?= $errors['URL'] ?></span>
        <?php endif; ?><br>
        <label for="Afbeeldingen">Afbeeldingen:</label><br>
        <textarea id="Afbeeldingen" name="Afbeeldingen" rows="4" cols="50"><?= $formValues['Afbeeldingen'] ?? '' ?></textarea><br>
        <label for="Prijs">Prijs:</label>
        <input type="text" id="Prijs" name="Prijs" value="<?= $formValues['Prijs'] ?? '' ?>">
        <?php if (isset($errors['Prijs'])): ?>
            <span style="color: red;"><?= $errors['Prijs'] ?></span>
        <?php endif; ?><br>
        <input type="submit" value="Toevoegen">
    </form>
</div>
</body>
</html>