<?php
session_start();

include("../secure.php");

require_once("../../../public/src/defines.php");
require_once(PATH_P_SRC."function.php");
require_once(PATH_CLASS."DataBase.Class.php");
require_once(PATH_CLASS."Discipline.Class.php");
require_once(PATH_CLASS."Prof.Class.php");
require_once(PATH_CLASS."OrderManager.Class.php");

header('Location: ../../pages/content.php');

$dataBase = new cDataBase(DATABASE_HOST, DATABASE_ADMIN_LOG, DATABASE_ADMIN_PASSWORD, DATABASE_ADMIN_NAME);

if (isset($_POST["id"]))
	$id = $_POST["id"];

$disc = new cDiscipline($id);

$disc->delete();

$_SESSION["tab-click"] = "disc";

//suppr id fron order.json
$om = new cOrderManager([	"action"=>"supprOrder",
							"file"=>"disc",
							"arg"=>["id"=>$id]]);
$om->execQuery();

exit();


?>