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
    $template = $twig->loadTemplate('gallery-item.tmpl');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    $sql = "SELECT * FROM images
            WHERE id=$id";
    $sth = $dbh->query($sql);

    $sth->setFetchMode(PDO::FETCH_ASSOC);

    while($row = $sth->fetch()) {
        $arPhoto = $row;
    }
    echo $template->render(array (
        'title' => "Фотография с id $id",
        'h1' => 'Фото ' . $arPhoto['name'],
        'name' => $arPhoto['name'],
        'src' => $arPhoto['src'],
        'small_src' => $arPhoto['small_src'],
    ));
} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}
