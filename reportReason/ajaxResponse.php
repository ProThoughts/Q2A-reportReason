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
	try
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{	
			echo $userId;
			echo $questionId;
			echo $reason;
			$cn = @new mysqli('localhost', 'root', 'root', 'forum');
			//$cn->query(
			//'INSERT INTO qa_uservotes (postid, userid, vote, flag, reason) VALUES ('.$questionId.', '.$userId.', 0, 1, "'.$reason.'")');
			$cn->query('INSERT INTO qa_uservotes (postid, userid, vote, flag, reason) VALUES ('.$questionId.', '.$userId.', 0, 1, "'.$reason.'") ON DUPLICATE KEY UPDATE flag=1');
		
		//return 'Sprawdzam: '.$userId.'&nbsp;'.$questionId.'&nbsp;'.$reason;
		
		//file_put_contents('test.txt', 'Udało się');
		
		}
		//return true;
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}

}

?>