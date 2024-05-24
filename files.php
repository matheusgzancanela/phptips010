<?php

use CoffeeCode\Uploader\File;

require __DIR__ . "/vendor/autoload.php";

$upload = new File("storage", "files");
$files = $_FILES;

if (!empty($files["file"])) {
  $file = $files["file"];

  if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
    echo "<p>Seleciona um arquivo válida</p>";
  } else {
    $uploaded = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 350);
    echo "<a target='_blank' href='{$uploaded}'>Acessar Arquivo</a>";
  }
}
?>

<form action="" method="post" enctype="multipart/form-data">
  <h1>Send File:</h1>
  <input type="file" name="file" />
  <button>Enviar</button>
</form>