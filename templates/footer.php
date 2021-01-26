<footer class="col-12 col-sm-12 col-md-8 col-lg-6 footer-connexion">	
	<div class="row">
		<div class="col-12 col-md-8 legals">
			<?php wp_nav_menu( array( 'theme_location' => 'legals' ) ); ?>
		</div>	
		<div class="col-12 col-md-4 social">
			<?php wp_nav_menu( array( 'theme_location' => 'social' , 'walker' => new social_walker() ) ); ?>
		</div>
	</div>
</footer>