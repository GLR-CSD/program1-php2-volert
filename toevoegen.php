<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    $formValues = [
        'AlbumID' => $_POST['AlbumID'] ?? '',
        'Title' => $_POST['Title'] ?? '',
        'Duur' => $_POST['Duur'] ?? '',
        'URL' => $_POST['URL'] ?? '',
    ];

    if (empty($_POST['AlbumID'])) {
        $errors['AlbumID'] = "AlbumID is verplicht.";
    }

    if (empty($_POST['Title'])) {
        $errors['Title'] = "Title is verplicht.";
    }

    if (!empty($_POST['URL']) && !filter_var($_POST['URL'], FILTER_VALIDATE_URL)) {
        $errors['URL'] = "Ongeldige URL.";
    }

    if (empty($errors)) {
        require_once 'db.php';
        require_once 'classes/Nummer.php';

        $nummer = new Nummer(
            null,
            $_POST['AlbumID'],
            $_POST['Title'],
            $_POST['Duur'],
            $_POST['URL']
        );

        $nummer->save($db);

    } else {
        $_SESSION['errors'] = $errors;
        $_SESSION['formValues'] = $formValues;
    }

    header("Location: album.php");
    exit;

} else {
    header("Location: album.php");
    exit;
}
