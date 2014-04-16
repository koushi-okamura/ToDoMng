<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-"8 />
   <title>ToDoMng - ToDoグループ管理 -  </title>
</head>
<body>

   <h1>ToDoグループ管理</h1>

<form action="ToDoMng_sub_group.php" method="post">

   <?php if (count($errors)): ?>
    <ul class="error_list">
    <?php foreach ($errors as $error): ?>
      <li>
      <?php echo htmlspecialchars($error,ENT_QUOTES,'UTF-8') ?>
      </li>
    <?php endforeach; ?>
    </ul>
   <?php endif; ?>
ToDoグループの作成<br />
ToDoグループ名：<input type="text" name="groupname" size="30" />
<input type="submit" name="submit" value="作成" /><br />
</form>
<br />

<form action="ToDoMng_sub_group.php" method="post">
ToDoグループの削除...<br />
ToDoグループ名：<select name="delgrp" style="width:215px">
   <?php if (count($posts) > 0): ?>
      <?php $cnt = 0; ?>
      <?php foreach($posts as $post): ?>
         <option value="<?php echo htmlspecialchars($post['todogroup'],ENT_QUOTES,'UTF-8'); ?>">
         <?php echo htmlspecialchars($post['todogroup'],ENT_QUOTES,'UTF-8'); ?>
         </option>
      <?php endforeach; ?>
   <?php endif; ?>
</select>
<input type="submit" name="submit" value="削除" /><br />
</form>




</body>
</html>
