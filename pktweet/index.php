<?php
//start session
session_start();
//var_dump($request_token,false);
var_dump($_SESSION['request_vars'],false);
//var_dump($_REQUEST,false);
//just simple session reset on logout click
if (isset($_GET["reset"])){
if($_GET["reset"]==1)
{
	session_destroy();
	header('Location: ./index.php');
}
}

// Include config file and twitter PHP Library by Abraham Williams (abraham@abrah.am)
include_once("config.php");
include_once("inc/twitteroauth.php");
?>
<?php

if(isset($_SESSION['status']) && $_SESSION['status']=='verified') 
{	//Success, redirected back from process.php with varified status.
	//retrive variables
	$screenname = $_SESSION['request_vars']['screen_name'];
	$twitterid = $_SESSION['request_vars']['user_id'];
	$oauth_token = $_SESSION['request_vars']['oauth_token'];
	$oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];

	//Show welcome message
//	echo '<div class="welcome_txt">Welcome <strong>'.$screenname.'</strong> (Twitter ID : '.$twitterid.'). <a href="index.php?reset=1">Logout</a>!</div>';
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
//        var_dump($connection);
}else{
	//login button
	echo '<a href="process.php"><img src="images/sign-in-with-twitter-l.png" width="151" height="24" border="0" /></a>';
}

?>
</div>
</body>
</html>
