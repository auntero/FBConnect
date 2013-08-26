<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('src/facebook.php');

  $config = array(
    'appId' => '187335971440787',
    'secret' => '4168ca02c8beac0833d9dff5ccc47fe6',
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
  
  function pre($varUse){  
    echo "<pre>";  
    print_r($varUse);  
    echo "</pre>";  
}  
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml"  
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Facebook Connect</title>
<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/Style.css">
<link rel="stylesheet" type="text/css" href="css/Layout.css">
<link rel="stylesheet" href="foundation/stylesheets/foundation.min.css">
  <link rel="stylesheet" href="foundation/stylesheets/app.css">

  
<script src="js/jquery203.js" type="text/javascript"></script>
<script src="js/functionContorl.js" type="text/javascript"></script>
<script src="foundation/javascripts/modernizr.foundation.js"></script>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '187335971440787',                        // App ID from the app dashboard
     // channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel file for x-domain comms
      status     : true,                                 // Check Facebook Login status
      xfbml      : true                                  // Look for social plugins on the page
    });

    // Additional initialization code such as adding Event Listeners goes here
  };

  // Load the SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
   var idFB,nameFB;
   function sendRequest(to,name) {
	   idFB=to;
	   nameFB=name;
    	FB.ui({method: 'apprequests', to: to, message: 'Debug Program for Testing', data: 'tracking information for the user'}, requestCallback);
    	return false;
  }
  /*

  function sendRequestViaMultiFriendSelector() {
    FB.ui({method: 'apprequests',
      message: 'My Great Request'
    }, requestCallback);
  }*/

  function requestCallback(response) {
	  if (response.request && response.to) {
               /* var request_ids = [];
                for(i=0; i<response.to.length; i++) {
                    var temp = response.request + '_' + response.to[i];
                    request_ids.push(temp);
                }
                var requests = request_ids.join(',');
                $.post('handle_requests.php',{uid: ?????, request_ids: requests},function(resp) {
                    // callback after storing the requests
                });*/
				sendDB(idFB,nameFB);
            } else {
                alert('canceled');
            }
  }
  
  
  
  
 
  
</script>
</head>

<body>
<header class="paddingTop10 row">
	<div class="twelve columns">
    <div class="panel">
	<h1>Facebook Connect</h1>
    </div>
    </div>
</header>
<article>
<?php
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $user_profile = $facebook->api('/'.$user_id,'GET');
		echo "<div class='row'>";
			echo "<div class='six columns'>";
				echo "<div class='panel'>";
					echo "Name: " . $user_profile['name'];
					echo "<br>";
					echo "first_name: " . $user_profile['first_name'];
					echo "<br>";
					echo "last_name: " . $user_profile['last_name'];
					echo "<br>";
					echo "locale: " . $user_profile['locale'];
					echo "<br>";
					echo "UserID: " . $user_id;
				echo "</div>";
			echo "</div>";
			
			echo "<div class='six columns'>";
				echo "<div class='panel'>";
					//$user_profile['picture'];
					//pre($testData);
					$json = file_get_contents('http://graph.facebook.com/'.$user_id.'/picture?width=180&height=220&redirect=false');
					$data = json_decode($json,true);
					$picurl=$data['data']['url'];  // mypicture profile
					
					///////////////////////////////////////////////////////////////////////////////////////////////////
					//$friends = $facebook->api('/'.$user_id.'/friends');
					//pre($friends);   // debug count friends
					//$friends = $facebook->api(array('query' => 'SELECT uid,name,pic_square FROM user WHERE uid in (SELECT uid2 FROM friend WHERE uid1 = 1165295299) ORDER BY name', 'method' => 'fql.query'));
					$friends = $facebook->api(array('query' => 'SELECT uid,name FROM user WHERE uid in (SELECT uid2 FROM friend WHERE uid1 = 1165295299) ORDER BY name', 'method' => 'fql.query'));
					//pre($friends);   // debug count friends
			
					$count = 0;
					foreach ($friends as $value) {
						$count++;
					}
					echo "count All Friend: ".$count." friends<br><br>";
				echo "</div>";
		
			echo "</div>";
		echo "</div>";
		
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////
		function loopFriend($value,$jsoncode,$finishVal,$typeVal){  
			$start=0;
			
			echo "<div class='row'>";
			echo "<div class='twelve columns'>";
			echo "<div class='panel text-center'  style='height:550px'>";
			
			for($value;$value<$finishVal;$value++){
				if($typeVal!="max"){
					echo '<div class="ln paddingTop10">';
					for($start=0;$start<3;$start++){
						
						
						
						echo '<div class="floatL paddingLeft10">';
						echo '<div class="pic">'.$jsoncode[$value]["uid"].'<br>';
						echo '<img src="http://graph.facebook.com/'.$jsoncode[$value]["uid"].'/picture?width=100&height=100" onclick="return sendRequest(\''.$jsoncode[$value]["uid"].'\',\''.$jsoncode[$value]["name"].'\')"/>';
						
						echo '</div>';
						echo '<div class="picName">'.$jsoncode[$value]["name"].'</div>';
						echo '</div>';
						
						
						$value++;
					}
					//$value = $start;
					$value=$value-1;
					echo '</div>';
				}else{
					$volumeVal=$finishVal-$value;
					
					if($volumeVal%3==0){
						echo '<div class="ln paddingTop10">';
						for($start=0;$start<3;$start++){
							echo '<div class="floatL paddingLeft10">';
							echo '<div class="pic">'.$jsoncode[$value]["uid"].'<br>';
							echo '<img src="http://graph.facebook.com/'.$jsoncode[$value]["uid"].'/picture?width=100&height=100" onclick="return sendRequest(\''.$jsoncode[$value]["uid"].'\',\''.$jsoncode[$value]["name"].'\')"/>';
							echo '</div>';
							echo '<div class="picName">'.$jsoncode[$value]["name"].'</div>';
							echo '</div>';
							$value++;
						}
						$value=$value-1;
						echo '</div>';
					}else{
						echo '<div class="ln paddingTop10">';
						if(floor($volumeVal/3)>0){
							for($start=0;$start<(floor($volumeVal/3));$start++){
								echo '<div class="floatL paddingLeft10">';
								echo '<div class="pic">'.$jsoncode[$value]["uid"].'<br>';
								echo '<img src="http://graph.facebook.com/'.$jsoncode[$value]["uid"].'/picture?width=100&height=100" onclick="return sendRequest(\''.$jsoncode[$value]["uid"].'\',\''.$jsoncode[$value]["name"].'\')"/>';
								echo '</div>';
								echo '<div class="picName">'.$jsoncode[$value]["name"].'</div>';
								echo '</div>';
								$value++;
							}
							$value=$value-1;
							echo '</div>';
							echo '<div class="ln paddingTop10">';
							for($start=0;$start<($volumeVal-(floor($volumeVal/3)*3));$start++){
								echo '<div class="floatL paddingLeft10">';
								echo '<div class="pic">'.$jsoncode[$value]["uid"].'<br>';
								echo '<img src="http://graph.facebook.com/'.$jsoncode[$value]["uid"].'/picture?width=100&height=100" onclick="return sendRequest(\''.$jsoncode[$value]["uid"].'\',\''.$jsoncode[$value]["name"].'\')"/>';
								echo '</div>';
								echo '<div class="picName">'.$jsoncode[$value]["name"].'</div>';
								echo '</div>';
								$value++;
							}
							$value=$value-1;
							echo '</div>';
						}else{
							echo '<div class="ln paddingTop10">';
							for($start=0;$start<($volumeVal-(floor($volumeVal/3)*3));$start++){
								echo '<div class="floatL paddingLeft10">';
								echo '<div class="pic">'.$jsoncode[$value]["uid"].'<br>';
								echo '<img src="http://graph.facebook.com/'.$jsoncode[$value]["uid"].'/picture?width=100&height=100" onclick="return sendRequest(\''.$jsoncode[$value]["uid"].'\',\''.$jsoncode[$value]["name"].'\')"/>';
								echo '</div>';
								echo '<div class="picName">'.$jsoncode[$value]["name"].'</div>';
								echo '</div>';
								$value++;
							}
							$value=$value-1;
							echo '</div>';	
						}
					}
					
					
				}
				
				
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
			
		}
		///////////////////////////////////////////////////////////////////////////////////////////////////
		if(!isset($_GET['page'])){

			loopFriend(0,$friends,9,"con");

	  	}else if($_GET['page']==ceil($count/9)){
			$selectPage = $_GET['page'];
			$i=($selectPage-1)*9;

			loopFriend($i,$friends,$count,"max");
			
		}else{
			$selectPage = $_GET['page'];
			$i=($selectPage-1)*9;
			$end=($selectPage)*9;
			
			loopFriend($i,$friends,$end,"con");

		}
		echo "<br>";
		
		echo "<div class='row'>";
		echo "<div class='twelve columns'>";
		echo "<div class='panel'>";
		
		echo "<br><div class='ln'>PAGE: ";
		echo "<br>";
		echo "| ";	
		for($page=1;$page<=ceil($count/9);$page++){	
			echo "<a href='index.php?page=$page'>".$page."</a> | ";
		}
		echo "</div><br>";
		echo "count".$count;
		
		echo '</div>';
		echo '</div>';
		echo '</div>';
		/*
		echo '<ul>';
        foreach ($friends["data"] as $value) {
            echo '<li>';
            echo '<div class="pic">';
            echo '<img src="https://graph.facebook.com/' . $value["id"] . '/picture"/>';
            echo '</div>';
            echo '<div class="picName">'.$value["name"].'</div>'; 
            echo '</li>';
        }
		echo '</ul>';
		*/
		
		
        
		/*
		$movies = $facebook->api('/'.$user_id.'/movies');
		echo '<ul>';
		 foreach ($movies["data"] as $value) {
            echo '<li>';
            echo $value["category"];
            echo $value["name"]; 
            echo '</li>';
        }
		echo '</ul>';*/

      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl(); 
        echo 'Please Login<br><a href="' . $login_url . '"><img src="pic/851577_183570091816923_346709518_n.png"/></a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      $login_url = $facebook->getLoginUrl();
      echo 'Please Login<br><a href="' . $login_url . '"><img src="pic/851577_183570091816923_346709518_n.png"/></a>';

    }

  ?> 
  <br> 
   
</article>
<footer>
	<div class="row">
  <div class="twelve columns">
  <div class="panel text-center">
  <img src="<?=$picurl?>" /> 
  </div>
  </div>
  </div>   
</footer>
</body>
</html>
