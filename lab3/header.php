<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/main.css">
</head>
<header>
	<div>
	<Img class="book2" src="img/bookclub.jpg">
		<nav id="main">
			<?php include("config.php") ?>	
			<ul>
				<li>
					<a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>" href="index.php">HOME</a>
				</li>

				<li>
					<a class="<?php echo $current_page == 'aboutus.php' ? 'active' : NULL ?>" href="aboutus.php">ABOUT</a>
				</li>


				<li>
					<a class="<?php echo $current_page == 'user.php' ? 'active' : NULL ?>" href="user.php">LOGIN</a>
				</li>

				<li>
					<a class="<?php echo $current_page == 'gallery.php' ? 'active' : NULL ?>" href="gallery.php">GALLERY</a>
				</li>

				<li>
					<a class="<?php echo $current_page == 'browsbooks.php' ? 'active' : NULL ?>" href="browsbooks.php">BROWSE BOOKS</a>
				</li>

				<li>
					<a class="<?php echo $current_page == 'mybooks.php' ? 'active' : NULL ?>" href="mybooks.php">MY BOOKS</a>
				</li>

				<li>
					<a class="<?php echo $current_page == 'contact.php' ? 'active' : NULL ?>" href="contact.php">CONTACT</a>
				</li>
			</ul>
		</nav>
	</div>
</header>
</html>
