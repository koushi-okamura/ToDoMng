<?php

include_once 'module/DB.php';
$mysqlobj = new DB;

include_once 'module/ToDoMng_Class.php';
$todomngobj = new ToDoMng;

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

  if($_POST['circlekey']){
    $posts = $todomngobj->ToDoListSelect($_POST['circlekey']);
    $circleset = $_POST['circlekey'];
    $circleselects = $todomngobj->ToDoCircleSet($_POST['circlekey']);
  }

  if($_POST['content']){
    //    echo $_POST['content'] . $_POST['todolist_key'],PHP_EOL;
    $todomngobj->ToDoListUpdate($_POST['content'],'',$_POST['todolist_key']);
  }

  if($_POST['group']){
    $errors = $todomngobj->ToDoGroupUpdate($_POST['group'],$_POST['group_key']);
  }
  
  if($_POST['group_select']){
    $todomngobj->ToDoGroupUpdateChecked($_POST['group_checked'],$_POST['group_select']);
    $posts = $todomngobj->ToDoListSelect($_POST['circleset']);
    $circleset = $_POST['circleset'];
    $circleselects = $todomngobj->ToDocircleSet($_POST['circleset']);
  }

}

$circles = $todomngobj->ToDoCircleSelect();

$groups = $todomngobj->ToDoGroupSelect();

// ビューファイルを読み込む
include 'views/ToDoMng_view_main.php';
