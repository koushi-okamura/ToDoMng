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

  function ToDoCircleSelect(){
    $sql = "SELECT todocircle_key,todocircle FROM ToDoCircle_Tbl"
      . " ORDER BY todocircle ASC;";
    $circles = array();
    $circles = self::Select($sql);
    return $circles;
  }

  function ToDoCircleSet($circle){
    $sql = "SELECT todocircle_key,todocircle FROM ToDoCircle_Tbl"
     . " WHERE todocircle_key = " . $circle . ";" ;
    $circles = array();
    $circles = self::Select($sql);
    return $circles;
  }
  function ToDoListSelect($circle){
    $sql = "SELECT todolist_key,todocircle_key,content,closing_day FROM ToDoList_Tbl"
     . " WHERE todolist_key = ANY(select todolist_key from ToDoGroup_Tbl where checked = true) "
     . " AND todocircle_key = " . $circle
     . " ORDER BY closing_day ASC;";

    $posts = array();
    $posts = self::Select($sql);
    return $posts;
  }

  function ToDoGroupSelect(){

    $sql = "SELECT todogroup_key,todolist_key,todogroup,checked FROM ToDoGroup_Tbl" 
         . " GROUP BY todogroup ORDER BY todogroup ASC;";

    $groups = array();
    $groups = self::Select($sql);
    return $groups;
  }


  function ToDoGroupCheck($name){
    // ToDoグループ名が正しく入力されているかチェック
    if (!isset($name) || !mb_strlen($name,'UTF-8')){
      $errors['groupname'] = 'ToDoグループ名を入力してください';
    }else if (mb_strlen($name,'UTF-8') > 15){
      $errors['groupname'] = 'ToDoグループ名は１５文字以内で入力してください';
    }
    return $errors;
  }

  function ToDoGroupInsert($name){
    $mysqlobj = new DB;
    // エラーがなければ保存
    $errors = self::ToDoGroupCheck($name);
    if (count($errors) === 0){
      $sql = "INSERT INTO ToDoGroup_Tbl(todogroup) VALUES ('"
	. $mysqlobj->Connect()->real_escape_string($name) . "');" ;

      $mysqlobj->Run($sql);

      header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
      //  }else{
      //    echo $errors['groupname'],PHP_EOL;
    }
    return $errors;
  }

  function ToDoGroupDelete($key){
    $mysqlobj = new DB;
    $sql = "DELETE FROM ToDoGroup_Tbl WHERE todogroup_key = "
      . $mysqlobj->Connect()->real_escape_string($key) . ";" ;

    $mysqlobj->Run($sql);

    header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
  }

  function ToDoGroupUpdate($name,$key){
    $mysqlobj = new DB;
    // エラーがなければ保存
    $errors = self::ToDoGroupCheck($name);
     // エラーがなければ保存
    if (count($errors) === 0){
      $sql = "UPDATE ToDoGroup_Tbl SET todogroup = '"
       . $mysqlobj->Connect()->real_escape_string($name) . "'"
       . "WHERE todogroup_key = " . $key . ";" ;

      $mysqlobj->Run($sql);

      //      header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
      //  }else{
      //    echo $errors['groupname'],PHP_EOL;
    }
    return $errors;
  }

  function ToDoGroupUpdateChecked($checked,$key){
    $mysqlobj = new DB;
    //  var_dump($_POST['group_select']);
    //  var_dump($_POST['group_checked']);
    $sql = "UPDATE ToDoGroup_Tbl SET checked = " . $checked
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