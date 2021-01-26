<h1>Paramètres de Trollmageddon</h1>
<div id="menu-tab">
    <div id="page-wrap"> 
        <div class="tabs">
            <div class="tab">
                <input id="tab-1" checked="checked" name="tab-group-1" type="radio" /> 
                    <label for="tab-1">Configuration</label> 

                    <div class="content"> 
                        <ul>
                        	<li>
                        	   <h3>Installation de Trollmageddon dans la BDD</h3>
                        	   <p>Cette option permet de créer les éléments nécessaires dans la base de données pour le bon fonctionnement du plugin</p>

                               <?php

                                    global $wpdb;

								    if (isset($_POST['create_table'])) {

    									$check="false";
    								    if (isset($_POST['validate'])) {
    								        $check = "true";
    								    }

    								    $table_name = $wpdb->prefix . 'troll_options';

    									$charset_collate = $wpdb->get_charset_collate();

    									$sql = "CREATE TABLE $table_name (
    										  troll_id mediumint(9) NOT NULL AUTO_INCREMENT,
    										  troll_name varchar(55),
    										  troll_value VARCHAR(20),
    										  PRIMARY KEY  (troll_id)
    										) $charset_collate;";

    									require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    									dbDelta( $sql );


    									$wpdb->insert( 
    									$table_name, 
    									array( 
    										'troll_name' => 'LaurentGrimaldi', 
    										'troll_value' => 'true',
    										) 
    									);

    									$wpdb->insert( 
    									$table_name, 
    									array( 
    										'troll_name' => 'troll_redirect', 
    										'troll_value' => 'false',
    										) 
    									);
								    }

                                    $checked="";
                                    $activate = $wpdb->get_var( "SELECT troll_value FROM ".$wpdb->prefix."troll_options WHERE troll_name = 'LaurentGrimaldi'" );

                                    if ($activate == "true") {
                                        $checked="checked";
                                    }

                                    if ($activate == "true") {
                                        echo "Installation faite";
                                        $style = "display: none;";
                                    } else {
                                        echo "Non Installé";
                                        $style = "display : inherit;";
                                    }
								?>

    							<form action="" method="POST">
    							    <input type="submit" value="Installer" name="create_table" style="<?php echo $style;?>">
    							</form>	

                        	</li>

                        	<li>
                        		<h3>Activation de l'interface Trollmageddon</h3>
                        		<p>En activant cette fonctionnalité vous mettez en place l'interface "auth" vérifier si avez bien réalisé les actions nécessaires pour la partie Auth</p>

                        		<?php 
									global $wpdb;

									if (isset($_POST['clique-ici'])) {
									    $check="false";
									    if (isset($_POST['validate'])) {
									        $check = "true";
									    }

									    $wpdb->update( 
									        $wpdb->prefix."troll_options", 
									        array( 
									           'troll_value' => $check 
									        ), 
									        array( 'troll_name' => 'troll_redirect' ), 
									        array( 
									            '%s'	// value1
									        )
									    );
									}

    									$checked="";
    									$activate = $wpdb->get_var( "SELECT troll_value FROM ".$wpdb->prefix."troll_options WHERE troll_name = 'troll_redirect'" );

    									if ($activate == "true") {
    									    $checked="checked";
    									}

    									if ($activate == "true") {
    									    echo "Plugin Activé";
    									} else {
    									    echo "Plugin Désactivé";
    									}
								?>

								<form action="" method="POST">
                                    <input type="checkbox" name="validate" <?php echo $checked;?>>
								    <input type="submit" value="Activer / Désactiver" name="clique-ici">
								</form>	

                        	</li>
                        <li>
                        	<h3>Mise à jour des permaliens</h3>
                        	<p>Après avoir activé ou désactivé l'interface de trollmageddon vous devez mettre <strong>IMPERATIVEMENT</strong> à jour les permaliens de Wordpress</p>
                        	<p>Aller dans la rubrique Réglages => Permaliens</p>
                        	<p>Sélectionner <strong>"NOM DE L'ARTICLE</strong></p>
                        	<p>Cliquer sur Mettre à jour en bas de votre page</p>

                        	<img src="/wp-content/plugins/trollmageddon/assets/manual/maj_permalink.jpg">

                        </li>
                    </ul>
                </div> 
            </div> 
            <div class="tab">
                <input id="tab-2" name="tab-group-1" type="radio" /> 
                    <label for="tab-2">Auth</label> 
                    <div class="content"> 
                        <h3>La section authentification vous permet de gérer vos pages de connexions.</h3>
                        <p>Trollmageddon à besoin pour fonctionner de différentes pages</p>
                        <ul>
                        	<li>La page de connexion</li>
                        	<li>La page d'inscription</li>
                        	<li>La page de validation</li>
                        	<li>La page de recupération de mot de passe</li>
                        </ul>

                        <p>Afin de faciliter la lecture du manuel, Trollmageddon vous invite à ouvrir les pages dans des onglets différents.</p>

                        <h3>Etape 1</h3>

                        <p>Vous devez aller dans la rubrique "Connexion" qui est sur votre menu de droite.</p>
                        <img src="/wp-content/plugins/trollmageddon/assets/manual/btn_login.jpg">

                        <h3>Etape 2</h3>

                        <p>Créer votre page de connexion</p>
                        <img src="/wp-content/plugins/trollmageddon/assets/manual/add_login_page.jpg">

                        <p>Donner lui le nom de votre choix</p>
                        <img src="/wp-content/plugins/trollmageddon/assets/manual/title_login_page.jpg">

                        <p>Mettez le message de votre choix dans la zone de commentaire</p>
                        <img src="/wp-content/plugins/trollmageddon/assets/manual/content_login_page.jpg">

                        <p>Avant de valider , vous devez modifier le permalien de la page, mettez ceci : login</p>
                        <img src="/wp-content/plugins/trollmageddon/assets/manual/permalink_login_page.jpg">

                        <p>Enregistrer votre page</p>
                        <img src="/wp-content/plugins/trollmageddon/assets/manual/btn_register.jpg">

                        <p>Bravo vous avez créer votre page de connexion</p>

                        <h3>Etape 3</h3>
                        <p>Faite la même chose que l'étape 2 avec les pages suivantes et les permaliens suivant</p>
                        <p>
                        	<ul>
                        		<li>Inscription => register<br>
                        			<img src="/wp-content/plugins/trollmageddon/assets/manual/permalink_register_page.jpg">
                        		</li>
                        		<li>Récupération de mot de passe => lostpassword<br>
                        			<img src="/wp-content/plugins/trollmageddon/assets/manual/permalink_lostpassword_page.jpg">
                        		</li>
                        		<li>Activation de compte => validate<br>
                        			<img src="/wp-content/plugins/trollmageddon/assets/manual/permalink_validate_page.jpg">
                        		</li>
                        	</ul>
                        </p>

                        <h3>Etape 4</h3>
                        <p>Mettre à jour les permaliens de wordpress</p>
                        <p>Aller dans la rubrique Réglages => Permaliens et cliquer sur enregistrer</p>
                        <img src="/wp-content/plugins/trollmageddon/assets/manual/maj_permalink.jpg">

                    </div> 
            </div> 
            <div class="tab">
                <input id="tab-3" name="tab-group-1" type="radio" /> 
                <label for="tab-3">Legal</label>

                <div class="content">
                    <h3>La section juridique vous permet de gérer vos pages d'information juridique</h3>
                    <p>Ces pages sont optionnelles, elles sont accessibles quel que soit le statut du visiteur.</p>
                    <ul>
                    	<li>La page des conditions générales</li>
                    	<li>La page des conditions d'utilisateur</li>
                    	<li>La page de signalement</li>
                    	<li>La page des demandes</li>
                    	<li>La page de statue de votre organisation</li>
                    	<li>La page des informations générales</li>
                    	<li>La page de documentation légal</li>
                    </ul>

                    <p>Afin de faciliter la lecture du manuel, Trollmageddon vous invite à ouvrir les pages dans des onglets différents.</p>

                    <h3>Etape 1</h3>

                    <p>Vous devez aller dans la rubrique "Juridique" qui est sur votre menu de droite.</p>
                    <img src="/wp-content/plugins/trollmageddon/assets/manual/btn_legal.jpg">

                    <h3>Etape 2</h3>

                    <p>Créer votre page de légal</p>
                    <img src="/wp-content/plugins/trollmageddon/assets/manual/add_legal_page.jpg">

                    <p>Donner lui le nom de votre choix</p>
                    <img src="/wp-content/plugins/trollmageddon/assets/manual/title_legal_page.jpg">

                    <p>Mettez le contenu de votre choix dans la zone de commentaire ( comme la page de connexion )</p>
                    <img src="/wp-content/plugins/trollmageddon/assets/manual/content_login_page.jpg">

                    <p>Avant de valider , vous devez modifier le permalien de la page ( comme la page de connexion )</p>
                    <p><strong>Voir la liste des permaliens disponible ci-dessous</strong></p>

                    <p>
                    	<ul>
                    		<li>La page des conditions générales => general-condition</li>
                    		<li>La page des conditions d'utilisateur => user-condition</li>
                    		<li>La page de signalement => report</li>
                    		<li>La page des demandes => regulation</li>
                        	<li>La page de status de votre organisation => status</li>
                    		<li>La page des informations générales => general-information</li>
                    		<li>La page de documentation légal => legal-documentation</li>
                        </ul>
                    </p>

                    <p>Enregistrer votre page</p>
                    <img src="/wp-content/plugins/trollmageddon/assets/manual/btn_register.jpg">
                    <p>Bravo vous avez créer votre page</p>

                    <h3>Etape 3</h3>

                    <p>Mettre à jour les permaliens de wordpress</p>
                    <p>Aller dans la rubrique Réglages => Permaliens et cliquer sur enregistrer</p>
                    <img src="/wp-content/plugins/trollmageddon/assets/manual/maj_permalink.jpg">

                </div>
            </div> 
            <div class="tab">
                <input id="tab-4" name="tab-group-1" type="radio" /> 
                <label for="tab-4">Widgets</label> 
                
                <div class="content">

                    <h3>Les Widgets Trollmageddon</h3>
                    <p>Lors de l'installation de Trollmageddon, des zones de widgets sont mises en place, certaines zones possèdent des indications "1 widget" cela signifie que Trollmageddon peut avoir des problèmes d'affichage si vous mettez plusieurs widgets</p>

                    <p>
                    Liste des zones de widgets ajoutés par Trollmageddon
                    	<ul>
                    		<li>Widget Bar => Barre vertical sur le côté droit ( connecté / non-connecté )</li>
                    		<li>Légals - Formulaire => Informations juridique dans les formulaires légals</li>
                    		<li>Validation - Formulaire => Information sur la page de validation</li>
                    		<li>Récupération de MDP => Message suplémentaire pour la récupération de mot de passe</li>
                        </ul>
                    </p>
                    
                    <img src="/wp-content/plugins/trollmageddon/assets/manual/widget_bar.jpg">

                </div>
            </div> 

            <div class="tab">
                <input id="tab-5" name="tab-group-1" type="radio" /> 
                <label for="tab-5">Menu</label> 

                <div class="content">
                    <h3>Les Menu Trollmageddon</h3>

                    <p>Lors de l'installation de Trollmageddon des zones de menu sont mises en place. Suivant vos besoins vous pouvez ajouter ou enlevé des liens comme bon vous semble</p>

                    <p>
                	Liste des zones de menu ajoutés par Trollmageddon
                    	<ul>
                        	<li>Menu Social - Icones</li>
                    		<li>Menu Legals - Informations légals</li>
                    		<li>Menu de validation</li>
                    	</ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
/*--------------Onglets--------------*/

.tabs {
      position: relative;   
      clear: both;
      margin: 25px 0;
    }
    .tab {
      float: left;
      margin-top:-10px;
    }
    .tab label {
    padding: 8px;
    border: 1px solid #ccc;
    margin-left: 4px;
    position: relative;
    left: 1px;
    font-size: 1.2em;
    }
    .tab [type=radio] {
      display: none;   
    }
    
/*--------------Contenu article onglet--------------*/
    .content {
        position: absolute;
        top: 21px;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 20px;
        margin-bottom: -20px;
        border-top: 1px solid #ccc;
    }
    .content > * {
      opacity: 0;
      
      -webkit-transform: translate3d(0, 0, 0);
    
      -webkit-transform: translateX(-100%);
      -moz-transform:    translateX(-100%);
      -ms-transform:     translateX(-100%);
      -o-transform:      translateX(-100%);
      
      -webkit-transition: all 0.6s ease;
      -moz-transition:    all 0.6s ease;
      -ms-transition:     all 0.6s ease;
      -o-transition:      all 0.6s ease;
    }
    
/*-------------Onglets actifs--------------*/

    [type=radio]:checked ~ label {
      background: white;
      z-index: 2;
      color: black;
      font-weight: 600;
    }
    [type=radio]:checked ~ label ~ .content {
      z-index: 1;
    }
    [type=radio]:checked ~ label ~ .content > * {
      opacity: 1;
      
      -webkit-transform: translateX(0);
      -moz-transform:    translateX(0);
      -ms-transform:     translateX(0);
      -o-transform:      translateX(0);
    }
/*--------------Images--------------*/

    .content img {
    border:4px solid white;
    margin: 0.5em 0;
    max-width: 420px;
    -webkit-transition: all 0.6s ease;
      -moz-transition:    all 0.6s ease;
      -ms-transition:     all 0.6s ease;
      -o-transition:      all 0.6s ease;
    }
    
    .content img:hover {
    opacity: 0.8;
    -webkit-transform: rotate(7deg);
      -moz-transform:    translateX(0);
      -ms-transform:     translateX(0);
      -o-transform:      translateX(0);
      
      -webkit-transition: all 0.6s ease;
      -moz-transition:    all 0.6s ease;
      -ms-transition:     all 0.6s ease;
      -o-transition:      all 0.6s ease;
      }
</style>