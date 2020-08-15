<?php

class SqlHelper {

  /* 
    description: This class gathers all the methods related to handling queries in mysql.
    methods: getConnection(), getFirstUser() 
  */

  private static function getConnection() {
    $serverName = "127.0.0.1:3307";
    $userName = "root";
    $pwd = "";
    $dbName = "zigi_entries";
    $connection = mysqli_connect($serverName, $userName, $pwd, $dbName);

    return $connection;
  }

  public static function getEntryBytitle($title) {
    $query = "SELECT content FROM entries WHERE title = ?";
    $conn = self::getConnection();
    $stmt = $conn->stmt_init();

    if ($stmt->prepare($query)) {
      $stmt->bind_param("s", $title);
      $stmt->execute();
      $result = $stmt->get_result();

      $stmt->close();
      $conn->close();
      return $result->fetch_assoc();
    }

    $stmt->close();
    $conn->close();
    return $stmt->error;
  }

  public static function getAllEntryTitles() {
    $conn = self::getConnection();
    $query = "SELECT title FROM entries";
    $results = $conn->query($query);
    $row = array();
    $currentResult = $results->fetch_assoc();
    
    while($currentResult != null) {
    array_push($row, $currentResult["title"]);
    $currentResult = $results->fetch_assoc();
    }

    return $row;
  }

  public static function insertEntry($title, $content) {
    $query = "INSERT INTO entries (title, content) VALUES (?, ?)";
    $conn = self::getConnection();
    $stmt = $conn->stmt_init();

    if ($stmt->prepare($query)) {
      $stmt->bind_param("ss", $title, $content);
      $stmt->execute();
      $stmt->close();
    }
    $conn->close();
  }
}
?>