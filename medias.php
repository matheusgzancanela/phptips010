<?php

use CoffeeCode\Uploader\Media;

require __DIR__ . "/vendor/autoload.php";

$upload = new Media("storage", "medias");
$files = $_FILES;

if (!empty($files["file"])) {
  $file = $files["file"];

  if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
    echo "<p>Seleciona uma mídia válida</p>";
  } else {
    $uploaded = $upload->upload($file, pathinfo($file["name"], PATHINFO_FILENAME), 350);
    echo "<a target='_blank' href='{$uploaded}'>Acessar Mídia</a>";
  }
}
$sended = filter_input(INPUT_GET, "sended", FILTER_VALIDATE_BOOLEAN);
if ($sended && empty($files["file"])) {
  echo "Selecione uma mídia de até " . ini_get("upload_max_file");
}
?>

<form action="?sended=true" method="post" enctype="multipart/form-data">
  <h1>Send Media:</h1>
  <input type="file" name="file" />
  <button>Enviar</button>
</form>