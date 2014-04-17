<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-"8 />
   <title>ToDoMng - ToDoリスト -  </title>
</head>
<body>

<script type="text/javascript">
   function doPost(form,type,value,name,value2,name2,action){
   //          alert('通過！！');
   //     name = name || "send"; //初期値
     var submitType = document.createElement("input");
     submitType.setAttribute("value",value);
     submitType.setAttribute("name",name);
     submitType.setAttribute("type","text");
     form.appendChild(submitType);

     var submitType2 = document.createElement("input");
     submitType2.setAttribute("value",value2);
     submitType2.setAttribute("name",name2);
     submitType2.setAttribute("type","hidden");
     form.appendChild(submitType2);

     //	  alert(value2);

     form.action = action;
     form.method = "post";
     form.submit();
    //     alert('通過後！！');
   }

</script>


   <h1>ToDoマネージャー</h1>

   <?php if (count($errors)): ?>
      <ul class="error_list">
         <?php foreach ($errors as $error): ?>
            <li>
               <?php echo htmlspecialchars($error,ENT_QUOTES,'UTF-8') ?>
            </li>
         <?php endforeach; ?>
      </ul>
   <?php endif; ?>

<table border="0">
  <tr>
    <td>
      <form action="ToDoMng.php" method="post">
      <table>
        <tr>
          <td valign="todolistheader">
            ToDoリスト<br />
            <input type="text" name="content_title" size="30" value="内容" readonly />
            <input type="text" name="closing_day_title" size="15" value="締日" readonly onclick="alert('ソート機能実装予定...')"/><br />
          </td>
        </tr>

        <tr>
          <td valign="todolist">
            <div style="width:400px;height:100px;overflow:auto">
              <?php if (count($posts) > 0): ?>
                <?php foreach($posts as $post): ?>
                  <input type="hidden" name="todolist_key" 
                  value="<?php echo htmlspecialchars($post['todolist_key'],ENT_QUOTES,'UTF-8'); ?>" />
                  <input type="hidden" name="todogroup_key"
                  value="<?php echo htmlspecialchars($post['todogroup_key'],ENT_QUOTES,'UTF-8'); ?>" />
                  <input type="hidden" name="todogroup" 
                  value="<?php echo htmlspecialchars($post['content'],ENT_QUOTES,'UTF-8'); ?>" />
                  <input type="text" name="content" maxlength="50" size="30" style="border:0;" 
                  value="<?php echo htmlspecialchars($post['content'],ENT_QUOTES,'UTF-8'); ?>" />
                  <input type="text" name="closing_day" size="15" style="border:0;" 
                  value="<?php echo htmlspecialchars($post['closing_day'],ENT_QUOTES,'UTF-8'); ?>" />
                  <br />
                <?php endforeach; ?>
              <?php endif; ?>

              <input type="hidden" name="todolist_key" value="" />
              <input type="hidden" name="todogroup_key" value="" />
              <input type="text" name="content" maxlength="50" size="30" style="border:0;" value="" />
              <input type="text" name="closing_day" size="15" style="border:0;" value="" />
              <br />
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <input type="submit" name="submit" value="ToDoの削除" /><br />
          </td>
        </tr>
      </table>
      </form>
    </td>
    <td>
      <table >
        <tr>
          <td valign="todogroup">
            ToDoグループ一覧
          </td>
        </tr>
        <tr>
          <td>
            <div style="width:250px;height:100px;overflow:auto">
            <form action="ToDoMng.php" method="post" >
              <?php if (count($groups) > 0): ?>
                <?php $cnt = 0; ?>
                <?php foreach($groups as $group): ?>
                  <input type="hidden" name="group_key<?php echo ++$cnt ; ?>"
                  value="<?php echo htmlspecialchars($group['todogroup_key'],ENT_QUOTES,'UTF-8'); ?>"
                  />
                  <input type="text" name="group" maxlength="15" size="30" style="border:0"
                  value="<?php echo htmlspecialchars($group['todogroup'],ENT_QUOTES,'UTF-8'); ?>"
                  onchange="doPost(form,this.type,this.value,this.name,
                  this.form.elements['group_key<?php echo $cnt; ?>'].value,'group_key','ToDoMng.php')"
                  />
                <?php endforeach; ?>
              <?php endif; ?>
            </form>
            </div>
          </td>
        </tr>
        <tr>
          <td>
            <br />
            <form action="ToDoMng_sub_group.php" method="post">
              <input type="submit" name="submit" value="ToDoグループ管理" /><br />
            </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<br />


</body>
</html>
