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
	<!--<link href="/wp-content/plugins/trollmagedon/templates/style.css" type='text/css' rel='stylesheet' />-->
	<link href="/wp-content/plugins/trollmageddon/templates/style.css" type='text/css' rel='stylesheet' />
	<script type="text/javascript" src="/wp-content/plugins/trollmageddon/templates/js/script.js"></script>


	<!--
		<link href="/wp-content/plugins/trollmagedon/templates/css/bootstrap.min.css" type='text/css' rel='stylesheet' />
		<script type="text/javascript" src="/wp-includes/js/jquery/jquery.js"></script>-->
		
	
</head>
<?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/post/content', get_post_format() );
	endwhile; // End of the loop.
?>

<body id="trollmageddon_legal">
	<p style="font-size: 10px; color:  #880000; position: absolute;"> <?php troll_version(); ?> </p>
	<header class="col-12 row">
		<a href="<?php bloginfo('url'); ?>"><span class="dashicons dashicons-arrow-left-alt"></span></a>
		<p>| <?php the_title(); ?><p>
	</header>
		<div class="conteneur">
			<div class="col-12 col-sm-12 col-md-8 wrap row">
				<main id="main" class="site-main" role="main">
					<?php the_content(); ?>
				</main>
			</div>
		</div>
