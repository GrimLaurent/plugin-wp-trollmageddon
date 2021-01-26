<!DOCTYPE html>
<html lang="fr">
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>

	<title><?php bloginfo( 'name' ); ?> | <?php the_title(); ?></title>

	<?php wp_head(); ?>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<!--Chargement du style-->
	<link href="/wp-content/plugins/trollmageddon/templates/style.css" type='text/css' rel='stylesheet' />
	<!--Chargement du script-->
	<script type="text/javascript" src="/wp-content/plugins/trollmageddon/templates/js/script.js"></script>
	
</head>
<body id="trollmageddon">




