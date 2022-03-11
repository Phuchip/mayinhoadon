<?
session_start();	

if(isset($_SESSION["logged"])){
	$_SESSION["logged"] = "0";
	unset($_SESSION["logged"]);
}
if(isset($_SESSION["user_id"]))	unset($_SESSION["user_id"]);
if(isset($_SESSION["userlogin"]))unset($_SESSION["userlogin"]);
if(isset($_SESSION["password"]))	unset($_SESSION["password"]);
if(isset($_SESSION["admin_id"]))	unset($_SESSION["admin_id"]);
if(isset($_SESSION["isAdmin"]))	unset($_SESSION["isAdmin"]);
if(isset($_SESSION["name"]))	unset($_SESSION["name"]);
if(isset($_SESSION["avatar"]))	unset($_SESSION["avatar"]);
if(isset($_SESSION["checsum"]))	unset($_SESSION["checsum"]);

?>
<script language="javascript">
	parent.location.href = "./login";
</script>
