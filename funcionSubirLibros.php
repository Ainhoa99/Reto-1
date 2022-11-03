<?php
//hh
function subirLibros()
{
    $archivo = isset($_REQUEST['foto']) ? $_REQUEST['foto'] : null;
    $target_dir = "C:\xampp\htdocs\Reto-1\src";
    $target_file = $target_dir . basename($_FILES[" $archivo"]["foto"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if ($check !== false) {
            echo "azala - " . $check["foto"] . " da.";
            $uploadOk = 1;
        } else {
            echo "Barkatu, argazkiak bakarrik igo daitezke";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "azala errepikatuta dago";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["$archivo"]["size"] > 500000) {
        echo "Barkatu, azalaren argazkia oso handia da.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "Barkatu, bakarrik JPG, JPEG eta PNG irudiak.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Barkatu, azala ezin izan da igo";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["$archivo"]["tmp_name"], $target_file)) {
            echo htmlspecialchars(basename($_FILES["$archivo"]["foto"])) . "azala ondo igo da.";
        } else {
            echo "Barkatu, arazo bat egon da azala igotzerakoan.";
        }
    }
}
