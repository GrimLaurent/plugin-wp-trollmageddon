<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 */ 

 //Appel du header de Trollmageddon
 include_once 'header.php';
?>

<?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/post/content', get_post_format() );
	endwhile; // End of the loop.
?>
<!--Version de Trollmageddon-->
<p style="font-size: 10px; color:  #880000; position: absolute;" class="troll_version"> <?php troll_version(); ?> </p>

<div id="auth" class="col-12 col-sm-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 wrap">
	<!--header-->
	<header class="row">
		<div class="col-6 offset-3 col-sm-6 offset-sm-3 col-md-3 offset-md-0 logoLogin">
			<?php if ( function_exists( 'the_custom_logo' ) ) {
	    		the_custom_logo();
			} ?>
		</div>
		<div class="col-md-8 descLogin">
			<h1><?php bloginfo( 'name' ); ?></h1>
			<p><?php bloginfo( 'description' ); ?></p>
		</div>
	</header>

	<main id="main" class="site-main" role="main">
		<div id="primary" class="content-area">
			
			<div class="row message_perso">
				<div class="col-12 messageText">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="currentPage col-12">
				<h2><?php the_title(); ?></h2>
			</div>
		<?php 
			if ( is_single('login')) {
				include_once 'error.php';
		?>
		<form method="post" action="<?php bloginfo('url'); ?>/wp-login.php" id="loginform" name="loginform">
			<div class="inputIdentifiant form-group input-group col-12">			
				<span class="iconIdentifiant"></span>
				<input type="text" tabindex="10" size="20" value="" placeholder="Email ou identifiant..." id="user_login" name="log" required>
			</div>				
			<div class="inputMdp form-group input-group col-12">
				<span class="iconMdp"></span>
				<input type="password" tabindex="20" size="20" value="" placeholder="Mot de passe..." id="user_pass" name="pwd" required>		
			</div>
			<div class="sav_login form-group input-group col-12">
				<label>
					<input type="checkbox" tabindex="90" value="forever" id="rememberme" name="rememberme">Rester connecter
				</label>		
			</div>	
			<div class="sav_login form-group input-group col-12">
				<input type="submit" tabindex="100" class="buttonLogin" value="Se connecter" id="wp-submit" name="wp-submit">
				<input type="hidden" value="<?php bloginfo('url'); ?>" name="redirect_to">
			</div>
			<div class="form-group input-group col-12 col-sm-6">
				<a href="#" class="buttonMoreOption moreOptions col-12">Plus d'options <span class="dashicons dashicons-arrow-down-alt2"></span></a>	
				<div class="moreOptionsBox form-group input-group">
					<a href="<?php bloginfo('url'); ?>/lostpassword">Mot de passe oublié</a>
					<a href="<?php bloginfo('url'); ?>/register">Inscription</a>
				</div>	
			</div>
		</form>
	<?php
	   // FIN DE LA ZONE DE CONNEXION
	} elseif (is_single('register')) {
		include_once 'error.php';
	?>

    	<?php
        	if(! empty($err) ) :
            	echo '<p class="alert alert-danger">'.$err.'';
        	endif;

        	if(! empty($success) ) :
            	echo '<p class="alert alert-danger">'.$success.'';
        	endif;
		?>
	
		<form method="post">

			<div class="inputNom form-group input-group col-12">
				<span class="iconIdentifiant"></span>
				<input type="text" value="" name="last_name" placeholder="Nom..." id="last_name" required />
			</div>

			<div class="inputPrenom form-group input-group col-12">	
				<span class="iconIdentifiant"></span>
				<input type="text" value="" name="first_name" placeholder="Prénom..." id="first_name" required />
			</div>
	
			<div class="inputEmail form-group input-group col-12">	
				<span class="iconMdp"></span>
				<input type="text" value="" name="email" placeholder="Email..." id="email" required />
			</div>
	
			<div class="inputUsername form-group input-group col-12">
				<span class="iconIdentifiant"></span>
				<input type="text" value="" name="username" placeholder="Nom d'utilisateur..." id="username" required />
			</div>
	
			<div class="inputPassword form-group input-group col-12">
				<span class="iconMdp"></span>
				<input type="password" value="" name="pwd1" placeholder="Mot de passe..." id="pwd1" required/>
			</div>
	
			<div class="inputRepassword form-group input-group col-12">
				<span class="iconMdp"></span>
				<input type="password" value="" name="pwd2" placeholder="Vérification mot de passe..." id="pwd2" required/>
			</div>  

   	    	<?php if ( is_active_sidebar( 'legals-information-form' ) ) : ?>        
				<div id="legals_information_form" class="nwa-header-widget widget-area" role="complementary">        
					<?php dynamic_sidebar( 'legals-information-form' ); ?>        
				</div>        
			<?php endif; ?>

			<div class="form-group input-group col-12">
				<button type="submit" name="btnregister" class="buttonLogin button" >S'inscrire</button>
				<input type="hidden" name="task" value="register" />
			</div>
		</form>

		<div class="form-group input-group col-6">
			<a href="<?php bloginfo('url'); ?>/auth/login" class="buttonLogin backLogin">< Connexion</a>
		</div>
	 
		<?php
			// FIN DE LA ZONE D'INSCRIPTION
    		} elseif(is_single('validate')) {
		?>
	
		<p class="textValidation">  
			<?php if ( is_active_sidebar( 'validate-information-form' ) ) : ?>        
				<div id="validate_information_form" class="nwa-header-widget widget-area" role="complementary">        
					<?php dynamic_sidebar( 'validate-information-form' ); ?>        
				</div>        
			<?php endif; ?>
		</p>
		
		<div class="form-row">			
			<div class="form-group input-group col-12">
				<?php wp_nav_menu( array( 'theme_location' => 'validate' ) ); ?>
			</div>
		</div>
	
	<?php
	// FIN DE LA ZONE DE VALIDATION
    } elseif (is_single('lostpassword')){
		include_once 'email.php';	
    ?>

    	<form method="post">

 			<?php if ( is_active_sidebar( 'lostpassword-information-form' ) ) : ?>        
				<div id="lostpassword_information_form" class="nwa-header-widget widget-area" role="complementary">        
					<?php dynamic_sidebar( 'lostpassword-information-form' ); ?>        
				</div>        
			<?php endif; ?>

			<p class="alert alert-warning">Pensez à verifier vos SPAM.</p>

    		<?php
        		if(! empty($error) ) :
            		echo '<p class="alert alert-danger">'.$error.'';
        		endif;
    		?>

            <div class="form-row">	
				<div class="inputNoPassword form-group input-group col-12">
					<span class="iconMdp"></span>
					<input type="text" name="email" placeholder="Email..." id="emailNoPwd"  value="" required/>
				</div>
			</div>
                
			<div class="form-row">			
				<div class="form-group input-group col-12">
					<input type="hidden" name="action" value="reset" />        
					<input type="submit" value="Récupérer votre mot de passe" class="buttonLogin button" id="submit" />
				</div>
			</div>	
		</form>
		<div class="form-row">
			<div class="form-group input-group col-6">
				<a href="<?php bloginfo('url'); ?>/auth/login" class="buttonLogin backLogin">< Connexion</a>
			</div>
		</div>
	</div>
	<?php
    	} else{
			echo "Je t'emmerde pecno !";
		}
	?>
	</main>
</div>

<?php include_once 'footer.php'; ?>