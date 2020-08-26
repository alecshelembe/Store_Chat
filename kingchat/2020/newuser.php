<!DOCTYPE html>
<html>
<head>
	<title>New User</title>
	<link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style type="text/css">
	
</style>
<body>
	<div class="container">
    <form action="new user back-end.php" method="POST" onsubmit="return check_both();">

      <input type="text" name="new_user" id="btn_username" placeholder="User">
      <input type="password" id="btn_password" onclick="check(btn_username);" name="password" placeholder="Password">
      <input type="submit" value="Create new user">
    </form>
  </div>
  <script type="text/javascript">
    let btn_username = document.getElementById("btn_username");
    let btn_password = document.getElementById("btn_password");

    function check(str) {

      var judge = true;

      if (str.value.length == 0) {
        judge = false;  
        str.focus();

      }

      return judge;

    }  

    function check_both() {

      var judge = true;
      var u = btn_username;
      var p = btn_password;
      if (p.value.length == 0) {judge = false; p.focus();}
      if (u.value.length == 0) {judge = false; u.focus();}

      return judge;
    }  

    document.onkeydown=function(evt){
      var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
      if(keyCode)
      {
            check(btn_username);
        }
    }   

  </script>
</body>
</html>