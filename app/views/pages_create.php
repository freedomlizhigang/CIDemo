
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
</head>
<body>
	<?php echo validation_errors();?>
	<?php echo form_open('pages/create');?>
	<label for="Title">Title</label>
	<input type="text" name="title" value="" /><br />
	<label for="Text">Text</label>
	<input type="text" name="text" value="" /><br />
	<input type="submit" name="submit" value="Create News">
	</form>
</body>
</html>