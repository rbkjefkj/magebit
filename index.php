<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale = 1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="./style.css" rel="stylesheet">
	<link href="./normalize.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div id="parent">
		<header id="header-mobile">
			<img src="./Union.svg">
			<nav>
				<ul>
					<li><a href="#">About</a></li>
					<li><a href="#">How it works</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</nav>
		</header>
		<div id="base">
			<header id="header">
				<img id="long-logo" src="./logo_pineapple.svg">
				<img id="tablet-sized-logo" src="./Union.svg">
				<nav>
					<ul>
						<li><a href="#">About</a></li>
						<li><a href="#">How it works</a></li>
						<li><a href="#">Contact</a></li>
					</ul>
				</nav>
			</header>
			<main>
				<h1>Subscribe to newsletter</h1>
				<p>Subscribe to our newsletter and get 10% discount on pineapple glasses.</p>
				<form id="form" action="/logic.php" method="POST" autocomplete="off">
					<div id="input-button">
						<input id="input" type="email" name="email" placeholder="Type your email address here..." value="<?php if (isset($email)) echo $email;?>">
						<input id="button" type="submit" disabled="false" value="">
					</div>
					<small id="small"><?php if (isset($emailErr)) echo $emailErr;?></small>
					<br>
					<div id="checkbox-label">
					<!--<input type="checkbox" id="terms">
					<label for="terms">I agree to <a href="#" id="tos">terms of service</a></label>-->
						<label class="container">I agree to
							<a href="#" id="tos">terms of service</a>
	  						<input id="checkbox" type="checkbox" name="checkbox">
	  						<span class="checkmark"></span>
						</label>
					</div><br>
					<small id="small2"><?php if (isset($checkboxErr)) echo $checkboxErr;?></small>
					<!--aesthetic line-->
				</form>
			</main>
			<footer>
				<a href="#" class="fa fa-facebook fa-lg"></a>
				<a href="#" class="fa fa-instagram fa-lg"></a>
				<a href="#" class="fa fa-youtube-play fa-lg"></a>
				<a href="#" class="fa fa-twitter fa-lg"></a>

				<!--<img id="Facebook" class="social-media" src="./Facebook.png"><!-
				<img id="Instagram" class="social-media" src="./Instagram.png">
				<img id="Youtube" class="social-media" src="./Youtube.png">
				<img id="Twitter" class="social-media" src="./Twitter.png">
				-->
			</footer>
		</div>
		<div id="pineapple">
		</div>
	</div>
</body>
<script src="./script.js"></script> <!--doesn't work when inside <head-->
</html>
