<?php

include_once 'module/DB.php';
$mysqlobj = new DB;

include_once 'module/ToDoMng_Class.php';
$todomngobj = new ToDoMng;

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

  if($_POST['content']){
  echo $_POST['content'] . $_POST['todolist_key'],PHP_EOL;
  }

  if($_POST['group']){
    $errors = $todomngobj->ToDoGrpUpdate($_POST['group'],$_POST['group_key']);
  }
  
  if($_POST['group_select']){
    $todomngobj->ToDoGrpUpdateChecked($_POST['group_checked'],$_POST['group_select']);
  }

}

$posts = $todomngobj->ToDoListSelect();

$groups = $todomngobj->ToDoGrpSelect();

// ビューファイルを読み込む
include 'views/ToDoMng_view_main.php';
