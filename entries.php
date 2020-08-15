<?php
define("ENTERIES_PATH", "temp filenames");
include "sqlHelper.php";

if(isset($_GET["title"])) {
  $title = $_GET["title"];
  $entry = SqlHelper::getEntryByTitle($title);

  if($entry == null) { 

    echo "<a href=\"/zigi/index.php\">all entries</a><br>";
    echo "no such entry";
  } else {
    echo "<a href=\"/zigi/index.php\">all entries</a><br>";
    echo "<h1>" . $title . "</h1>";
    echo "<pre>" . $entry["content"] . "</pre>";
  }
} else {
  $entries = SqlHelper::getAllEntryTitles();
  $str = "<ul>";
  foreach($entries as $entry) $str .= "<li><a href=\"/zigi/index.php/" . $entry . "\">" . $entry . "</a></li>";
  $str .= "</ul>";
  echo $str;

  if(true) include "adminEntries.php";
}
?>