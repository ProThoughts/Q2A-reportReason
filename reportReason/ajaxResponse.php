<?php

if(isset($_POST))
{
	if(isset($_POST['function']) && $_POST['function']=="addReport")
	{
		if((isset($_POST['userId'])) && (isset($_POST['questionId'])) && (isset($_POST['reason'])))
		{
		header('Content-Type: text/html');
		addReport($_POST['userId'], $_POST['questionId'], $_POST['reason']);
		}
	}
}

function addReport($userId, $questionId, $reason)
{
	require_once '../../qa-config.php';
	
	   try
   {
      $pdo = new PDO('mysql:host='.QA_MYSQL_HOSTNAME.';dbname='.QA_MYSQL_DATABASE, QA_MYSQL_USERNAME, QA_MYSQL_PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $stmt = $pdo->query('INSERT INTO qa_uservotes (postid, userid, vote, flag, reason) VALUES ('.$questionId.', '.$userId.', 0, 1, "'.$reason.'")');

   }
   catch(PDOException $e)
   {
      echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
   }

}

?>