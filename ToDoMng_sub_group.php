<?php
// データベースに接続
include_once 'module/DB.php';
$mysqlobj = new DB;


$errors = array();


class ToDoGrp_Tbl
{

  function Run_ToDoGrp_Tbl($mysqlobj,$sql){
    $result = $mysqlobj->Query($sql);
    $mysqlobj->Query('commit;');
    return $result;
  }

}

$obj = new ToDoGrp_Tbl;


// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
  switch($_POST['submit']){
  case '作成':
  // ToDoグループ名が正しく入力されているかチェック
  if (!isset($_POST['groupname']) || !mb_strlen($_POST['groupname'],'UTF-8')){
    $errors['groupname'] = 'ToDoグループ名を入力してください';
  }else if (mb_strlen($_POST['groupname'],'UTF-8') > 15){
    $errors['groupname'] = 'ToDoグループ名は１５文字以内で入力してください';
  }
   

  // エラーがなければ保存
  if (count($errors) === 0){
 
    $sql = "INSERT INTO ToDoGrp_Tbl(todogroup) VALUES ('"
      . $mysqlobj->Connect()->real_escape_string($_POST['groupname']) . "');" ;

    $obj->Run_ToDoGrp_Tbl($mysqlobj,$sql);

    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    //  }else{
    //    echo $errors['groupname'],PHP_EOL;
  }
  break;
  case '削除':
        $sql = "DELETE FROM ToDoGrp_Tbl WHERE todogroup = '"
         . $mysqlobj->Connect()->real_escape_string($_POST['delgrp']) . "';" ;

        $obj->Run_ToDoGrp_Tbl($mysqlobj,$sql);

        header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

	break;
  }
}


$sql = "SELECT todogroup FROM ToDoGrp_Tbl;";
$result = $obj->Run_ToDoGrp_Tbl($mysqlobj,$sql);

// 取得した結果を$postsに格納
$posts = array();
if($result !== false && $result->num_rows){
  while ($post = $result->fetch_assoc()){
    $posts[] = $post;
  }
}

// 取得結果を開放して接続を閉じる
$result->free();
$result->close();
//$mysqlobj->close();

// ビューファイルを読み込む
include 'views/ToDoMng_view_group.php';

