
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
</head>
<body>
	<p>ID - Title - Text - Slug</p>
	<p><?php echo $news_item['id'];?> - <?php echo $news_item['title'];?> - <?php echo $news_item['text'];?> - <?php echo $news_item['slug'];?></p>
</body>
</html>