<?php

session_start();

class MyDB extends SQLite3
{
   function __construct()
   {
      $this->open('../database/planej.db');
   }
}

$db = new MyDB();

if(!$db) {
    echo $db->lastErrorMsg();
}

?>