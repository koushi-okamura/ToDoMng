<?php

class ToDoMng{

  function Select($sql){

    $mysqlobj = new DB;
    $result = $mysqlobj->Run($sql);

    // 取得した結果を$postsに格納
    $posts = array();
    if($result !== false && $result->num_rows){
      while ($post = $result->fetch_assoc()){
	$posts[] = $post;
      }
    }

    $result->free();
    $result->close();

    return $posts;
  }

  function ToDoListSelect(){

    $sql = "SELECT todolist_key,todogroup_key,content,closing_day FROM ToDoList_Tbl"
     . " WHERE todogroup_key = ANY(select todogroup_key from ToDoGrp_Tbl where checked = true) "
     . " ORDER BY closing_day ASC;";

    $posts = array();
    $posts = self::Select($sql);
    return $posts;
  }

  function ToDoGrpSelect(){

    $sql = "SELECT todogroup_key,todogroup,checked FROM ToDoGrp_Tbl ORDER BY todogroup ASC;";

    $groups = array();
    $groups = self::Select($sql);
    return $groups;
  }

  function ToDoGrpCheck($name){
    // ToDoグループ名が正しく入力されているかチェック
    if (!isset($name) || !mb_strlen($name,'UTF-8')){
      $errors['groupname'] = 'ToDoグループ名を入力してください';
    }else if (mb_strlen($name,'UTF-8') > 15){
      $errors['groupname'] = 'ToDoグループ名は１５文字以内で入力してください';
    }
    return $errors;
  }

  function ToDoGrpInsert($name){
    $mysqlobj = new DB;
    // エラーがなければ保存
    $errors = self::ToDoGrpCheck($name);
    if (count($errors) === 0){
      $sql = "INSERT INTO ToDoGrp_Tbl(todogroup) VALUES ('"
	. $mysqlobj->Connect()->real_escape_string($name) . "');" ;

      $mysqlobj->Run($sql);

      header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
      //  }else{
      //    echo $errors['groupname'],PHP_EOL;
    }
    return $errors;
  }

  function ToDoGrpDelete($key){
    $mysqlobj = new DB;
    $sql = "DELETE FROM ToDoGrp_Tbl WHERE todogroup_key = "
      . $mysqlobj->Connect()->real_escape_string($key) . ";" ;

    $mysqlobj->Run($sql);

    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  }

  function ToDoGrpUpdate($name,$key){
    $mysqlobj = new DB;
    // エラーがなければ保存
    $errors = self::ToDoGrpCheck($name);
     // エラーがなければ保存
    if (count($errors) === 0){
      $sql = "UPDATE ToDoGrp_Tbl SET todogroup = '"
       . $mysqlobj->Connect()->real_escape_string($name) . "'"
       . "WHERE todogroup_key = " . $key . ";" ;

      $mysqlobj->Run($sql);

      //      header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
      //  }else{
      //    echo $errors['groupname'],PHP_EOL;
    }
    return $errors;
  }

  function ToDoGrpUpdateChecked($checked,$key){
    $mysqlobj = new DB;
    //  var_dump($_POST['group_select']);
    //  var_dump($_POST['group_checked']);
    $sql = "UPDATE ToDoGrp_Tbl SET checked = " . $checked
     . " WHERE todogroup_key = " . $key . ";";
    //    echo $sql,PHP_EOL;
    $mysqlobj->Run($sql);
  }

  function ToDoListUpdate($content,$date,$key){
    $mysqlobj = new DB;
    $sql = "UPDATE ToDoList_Tbl SET content = " . $content
     . ", closing_day = " . $date
     . " WHERE todolist_key = " . $key . ";";
    echo $sql.PHP_EOL;
    //    $mysqlobj->Run($sql);
  }

}




?>