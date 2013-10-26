<?php 
/**
 * @file
 * Main page view
 *
 * The main page view - including the form and the output printing area.
 */
$path = dirname($_SERVER['PHP_SELF']).'/view/';
	if(isset($return_message_array) && isset($return_message_array['error'])) {
		$error = $return_message_array['error'];
		$text = $return_message_array['content'];
	} else if(isset($return_message_array)) {
		$success = "Your message was submitted";
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="<?php print $path ?>css/normalize.css">
        <link rel="stylesheet" href="<?php print $path ?>css/main.css">
        <script src="<?php print $path ?>js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
		<h1>Secrets... </h1>
		<?php if(isset($error)): ?>
			<div class='error'>
				<?php print $error; ?>
			</div>
		<?php endif; ?>
		<?php if(isset($success)): ?>
			<div class='success'>
				Your message submitted.
			</div>
		<?php endif; ?>
		<p>Post your most intimate thoughts here..</p>
		<form action="<?php echo $_SERVER['PHP_SELF'].'?page=message' ?>" method="post">
			<textarea rows="20" cols="200" id='message' name='message'><?php if(isset($error)) {print $text;}?></textarea>
			<input type="submit" value="Confess">
		</form>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="<?php print $path ?>js/plugins.js"></script>
        <script src="<?php print $path ?>js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
    </body>
</html>
