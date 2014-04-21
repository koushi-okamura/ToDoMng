<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-"8 />
   <title>ToDoMng - ToDoリスト -  </title>
</head>
<body>

<script type="text/javascript">
   function doAppendChild(form,value,name){
     var submitType = document.createElement("input");
     submitType.setAttribute("value",value);
     submitType.setAttribute("name",name);
     submitType.setAttribute("type","hidden");
     form.appendChild(submitType);
   }
   function doSubmit(form,action){
     form.action = action;
     form.method = "post";
     form.submit();
   }

</script>


   <h1>ToDoマネージャー</h1>
<form>
<select name="circlekey" style="width:430px"
onchange="doAppendChild(form,this.value,this.name);
          doSubmit(form,'ToDoMng.php')"
>
  <option value="">現在表示中のToDoサークル名：
  <?php if(count($circleselects) > 0): ?>
    <?php foreach($circleselects as $circleselect): ?>
      <?php echo htmlspecialchars($circleselect['todocircle'],ENT_QUOTES,'UTF-8'); ?>
    <?php endforeach; ?>
  <?php endif; ?></option>
  <?php if (count($circles) > 0): ?>
    <?php foreach($circles as $circle): ?>
      <option value="<?php echo htmlspecialchars($circle['todocircle_key'],ENT_QUOTES,'UTF-8'); ?>">
        <?php echo htmlspecialchars($circle['todocircle'],ENT_QUOTES,'UTF-8'); ?>
      </option>
    <?php endforeach; ?>
  <?php endif; ?>
</select>
</form>
<br />

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
   <?php $cnt = 0; ?>
                <?php foreach($posts as $post): ?>
<?php ++$cnt ?>
                  <input type="hidden" name="todolist_key<?php echo $cnt; ?>" 
                  value="<?php echo htmlspecialchars($post['todolist_key'],ENT_QUOTES,'UTF-8'); ?>" />
                  <input type="hidden" name="todocircle_key"
                  value="<?php echo htmlspecialchars($post['todocircle_key'],ENT_QUOTES,'UTF-8'); ?>" />
                  <input type="text" name="content" maxlength="50" size="30" style="border:0;" 
                  value="<?php echo htmlspecialchars($post['content'],ENT_QUOTES,'UTF-8'); ?>" 
                  onchange="doAppendChild(form,this.value,this.name);
                            doAppendChild(form,this.form.elements['todolist_key<?php echo $cnt; ?>'].value,'todolist_key');
                            doSubmit(form,'ToDoMng.php')"
                  />
                  <input type="text" name="closing_day" size="15" style="border:0;" 
                  value="<?php echo htmlspecialchars($post['closing_day'],ENT_QUOTES,'UTF-8'); ?>" />
                  <br />
                <?php endforeach; ?>
              <?php endif; ?>

              <input type="hidden" name="todolist_key" value="" />
              <input type="hidden" name="todocircle_key" value="" />
              <input type="text" name="content" maxlength="50" size="30" style="border:0;" value=""
              onchange="doAppendChild(form,this.value,this.name);
                        doSubmit(form,'ToDoMng.php')"
              />
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
            <div style="width:320px;height:100px;overflow:auto">
            <form action="ToDoMng.php" method="post" >
              <?php if (count($groups) > 0): ?>
                <?php $cnt = 0; ?>
                <?php foreach($groups as $group): ?>
                  <?php ++$cnt; ?>
                  <input type="checkbox" name="group_select<?php echo $cnt ; ?>"
                  value="<?php echo htmlspecialchars($group['todogroup_key'],ENT_QUOTES,'UTF-8'); ?>"
                  onclick="this.blur();this.focus();"
                  onchange="doAppendChild(form,this.value,'group_select');
                            doAppendChild(form,this.checked,'group_checked');
doAppendChild(form,<?php echo $circleset; ?>,'circleset');
                            doSubmit(form,'ToDoMng.php');"
                  <?php if($group['checked'] == true) { ?>checked="checked" <?php } ?>
                  />
                  <input type="hidden" name="group_key<?php echo $cnt ; ?>"
                  value="<?php echo htmlspecialchars($group['todogroup_key'],ENT_QUOTES,'UTF-8'); ?>"
                  />
                  <input type="hidden" name="list_key<?php echo $cnt ; ?>"
                  value="<?php echo htmlspecialchars($group['todolist_key'],ENT_QUOTES,'UTF-8'); ?>"
                  />
                  <input type="text" name="group" maxlength="15" size="30" style="border:0"
                  value="<?php echo htmlspecialchars($group['todogroup'],ENT_QUOTES,'UTF-8'); ?>"
                  onchange="doAppendChild(form,this.value,this.name);
                            doAppendChild(form,this.form.elements['group_key<?php echo $cnt; ?>'].value,'group_key');
                            doSubmit(form,'ToDoMng.php')"

                  />
                  <input type="button" name="group_move<? echo $cnt; ?>"
                  value="移動"
                  />
                  <br />
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
