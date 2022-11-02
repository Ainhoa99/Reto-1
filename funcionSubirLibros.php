<?php
//hh
function subirLibros()
{
    $archivo = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null;
    $target_dir = "C:\xampp\htdocs\Reto-1";
    $target_file = $target_dir . basename($_FILES[" $archivo"]["foto"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (file_exists($target_file)) {
        echo "Argazki hau artuta dago";
        $uploadOk = 0;

        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["$archivo"]["tmp_name"]);
            if ($check !== false) {
                echo "Argazkiak ez ditu neurriak betetzen ";
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }
        }
    }
}
