<?php 
  if(isset($_POST["byfilehandle"])) {
    $fileName = htmlspecialchars($_POST["heading"]) . ".txt";
    $baseFolder = "temp filenames/";
    $fileContant = htmlspecialchars($_POST["contant"]);

    $fileHandle = fopen($baseFolder . $fileName, "w");
    fwrite($fileHandle, $fileContant);

    fclose($fileHandle);
  } else if(isset($_POST["bysql"])) {
    $title = htmlspecialchars($_POST["heading"]);
    $content = htmlspecialchars($_POST["contant"]);
    echo SqlHelper::insertEntry($title, $content);
  }
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="text" name="heading">
<textarea name="contant"></textarea>
<input type="submit" value="add by file handling" name="byfilehandle">
<input type="submit" value="add by sql" name="bysql">
</form>