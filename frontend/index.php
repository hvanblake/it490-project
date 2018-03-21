<!DOCTYPE html>
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>IT490</title>
<style type="text/css">
.ms-list8-main {
	border: .75pt solid black;
	background-color: #FFFFDD;
}
.ms-list8-tl {
	font-weight: bold;
	color: black;
	border-left-style: none;
	border-right-style: none;
	border-top-style: none;
	border-bottom: .75pt solid black;
	background-color: yellow;
}
.ms-list8-left {
	font-weight: bold;
	color: black;
	border-style: none;
}
.auto-style1 {
	text-align: center;
}
.auto-style2 {
	text-align: center;
	color: #FF0000;
}
.auto-style3 {
	font-weight: bold;
	color: black;
	text-align: center;
	border-left-style: none;
	border-right-style: none;
	border-top-style: none;
	border-bottom: .75pt solid black;
	background-color: yellow;
}
.auto-style4 {
	font-weight: bold;
	color: black;
	text-align: center;
	border-style: none;
}
table 
{
    margin:auto;
}
</style>
</head>

<body>
<?php
session_start();
echo 'user:';
echo $_SESSION['username'];
echo 'user:pass:     ';
echo $_SESSION['test'];
if($_SESSION['username'] == 'index.php')
{
 echo 'incorrect username/ password please try again.' ;
}
?>

<form id="login" method="POST" action="send.php">
<table class="ms-list8-main" style="width: 30%">
	<!-- fpstyle: 31,011111100 -->
	<tr>
		<td class="auto-style3" colspan="3" style="height: 23px">Login</td>
	</tr>
		<tr>
		<td class="ms-list8-left">Username:</td>
		<td class="auto-style1">
			<input id="username" name="username" style="width: 300px; height: 20px" type="text" id="Username" /></td>
	</tr>
	<tr>
		<td class="ms-list8-left">Password:</td>
		<td class="auto-style1">
		<input id="password" name="password" style="width: 300px; height: 20px" type="text" id="Password" /></td>
	</tr>
		<tr>
		<td></td>
		<td class="auto-style4">
			<input id="Submit" name="Submit" type="submit" value="Submit" formaction="send.php" />
			<input id="Register" name="Register" type="submit" value="Sign up" formaction="send2.php" />
		</td>
	</tr>
</table>
</form>
</body>
</html>
