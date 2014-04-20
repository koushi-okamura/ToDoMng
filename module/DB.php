<?php
class DB
{
  function Connect($status = array()){
    $mysqlobj = new mysqli('localhost','ToDoUser','ToDoPass','ToDoManager_DB');
    if (mysqli_connect_errno()){
      die('データベースに接続できません：' . mysqli_connect_errno());
    }else{
      $mysqlobj->set_charset("utf8");
      return $mysqlobj;
    }
  }

  function Query($sql){
    $mysqlobj = $this->Connect();
    $result = $mysqlobj->query($sql);
    return $result;  
  }

  function Run($sql){
    $result = self::Query($sql);
    self::Query('commit;');
    return $result;
  }


}
