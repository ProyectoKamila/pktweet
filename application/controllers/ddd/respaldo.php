<?php

        define('CONSUMER_KEY', 'uZVld72gVQlyWlLmq2JvQlEXy');
        define('CONSUMER_SECRET', 'GsnVPoHtp4JgxBgLgznJ0sakBAwRRcPgyXuxiUsBKvc14JtiQX');
        define('OAUTH_CALLBACK', 'http://127.0.0.1/pktweetsvn/process');
        
$urlapi = "statuses/user_timeline.json?screen_name=".$this->data['screenname']."&count=5";
$tweets = $connection->get("https://api.twitter.com/1.1/".$urlapi);
$this->data['tname'] = $tweets[0]->user->name;
$this->data['timg'] = $tweets[0]->user->profile_image_url;

    public function process() {
$this->config();
        require_once('./application/libraries/twitteroauth.php');

        if (isset($_REQUEST['oauth_token']) && isset($_SESSION['token']) !== $_REQUEST['oauth_token']) {

// if token is old, distroy any session and redirect user to index.php
//	session_destroy();
            header('Location: ./');
        } elseif (isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']) {

// everything looks good, request access token
//successful response returns oauth_token, oauth_token_secret, user_id, and screen_name
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'], $_SESSION['token_secret']);
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if ($connection->http_code == '200') {
//redirect user to twitter
                $_SESSION['status'] = 'verified';
                $_SESSION['request_vars'] = $access_token;


// unset no longer needed request tokens
                unset($_SESSION['token']);
                unset($_SESSION['token_secret']);
//        debug("rrr");
                header('Location: ./');
            } else {
                die("error, try again later!");
            }
        } else {

            if (isset($_GET["denied"])) {
                
                header('Location: ./');
                die();
            }

//fresh authentication
            $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
            $request_token = $connection->getRequestToken(OAUTH_CALLBACK);

//received token info from twitter
            $_SESSION['token'] = $request_token['oauth_token'];
            $_SESSION['token_secret'] = $request_token['oauth_token_secret'];

// any value other than 200 is failure, so continue only if http code is 200
            if ($connection->http_code == '200') {
//redirect user to twitter
                $twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
                
                header('Location: ' . $twitter_url);
            } else {
                die("error connecting to twitter! try again later!");
            }
        }
        }
        
        
        define('CONSUMER_KEY', 'I7OMwbWZEeQ5L7wU9mRcK3Say');
        define('CONSUMER_SECRET', 'ALW67UrnhP52CKQgcuMsRHgzdU4sqFuE3D5aUiNbqA50KyegYS');
    