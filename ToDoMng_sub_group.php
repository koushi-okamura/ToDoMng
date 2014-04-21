<?php
include_once 'module/DB.php';
$mysqlobj = new DB;

require_once 'module/ToDoMng_Class.php';
$todomngobj = new ToDoMng;

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  switch($_POST['submit']){
  case '作成':
    $errors = $todomngobj->ToDoGroupInsert($_POST['groupname']);
    break;
  case '削除':
    $todomngobj->ToDoGroupDelete($_POST['groupkey']);
    break;
  }
}

$posts = $todomngobj->ToDoGroupSelect();

// ビューファイルを読み込む
include 'views/ToDoMng_view_group.php';
