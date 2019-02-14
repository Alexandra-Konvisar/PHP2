<?php
include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $dbh = new PDO('mysql:dbname=php1;host=localhost', 'root', '');
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    $template = $twig->loadTemplate('gallery.tmpl');

    $sql = "SELECT * FROM images";
    $sth = $dbh->query($sql);

    $sth->setFetchMode(PDO::FETCH_ASSOC);

    while($row = $sth->fetch()) {
        $arPhoto[] = $row;
    }
    echo $template->render(array (
        'title' => "Фотогалерея",
        'h1' => 'Фотогалерея',
        'photos' => $arPhoto,
    ));
} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}
