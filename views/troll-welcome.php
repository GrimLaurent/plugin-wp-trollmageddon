<img src="/wp-content/plugins/trollmageddon/assets/login.svg" style="width: 8em; margin: 2em 0 0.5em; ">
<h1><?php troll_version(); ?></h1>
<h2>Plugin de gestion de connexion</h2>
<h3>Un plugin pour les amener tous, et dans le jeu les lier</h3>

<div id="menu-tab">
  <div id="page-wrap"> 
    <div class="tabs">
      <div class="tab">
      
        <input id="tab-1" checked="checked" name="tab-group-1" type="radio" /> 
        <label for="tab-1">Présentation</label> 

          <div class="content"> 
            <h4>En quelques mots</h4>
            <p>L'objectif de ce plugin est de mettre en place un système d'intranet amélioré pour wordpress, qui assure la prise en charge du Wordpress et ça sécurité.</p>
            <p>Trollmageddon à été développé afin d'éviter la "surcharge" de plugin de modification de page de connexion souvent très lourd , peu pratique et n'assure pas une bonne prise en charge de votre CMS Wordpress</p>

            <h4>Comment fonctionne-t-il ?</h4>
            <p>Afin de ne pas compliquer son utilisation, il y a peu de paramètres à prendre en compte. Vous avez le choix entre un verrouillage personnalisé ou un verrouillage par défaut via le wp-login de votre CMS</p>
            <p>Il fonctionne de manière à bloquer toutes les entrées non-connectées sur l'ensemble de votre site web une foi activé.</p>

            <h4>Qu'apporte-t-il à Wordpress ?</h4>
            <p>Trollmageddon apporte une gestion autonome de l'intranet, lorsque vus l'avez activé, il vous rajoute un onglet Connexion et Juridique.</p>
            <p>Cela vous offre la possibilité de créer des pages pour la réglementation sans bloquer l'accès à ces informations juridiques pour être en conformité avec la réglementation Européenne.</p>
            <p>La partie connexion vous offre la possibilité d'afficher un message personnalisé sur chaque page de connexion.</p>

            <h4>Puis-je mettre à jour mon CMS ?</h4>
            <p>Normalement, oui, Trollmageddon vous invite cependant à faire une sauvegarde complète du CMS et de la base de données afin d'être tranquille</p>

            <h4>Pourquoi Trollmageddon ?</h4>
            <p>Ce nom est un hommage à la série YouTube Noob ou Tenshirock le Hacker essaye de mettre des plans de domination des joueurs. " C'est une très bonne série - un développeur Fan. "</p>

          </div> 
        </div> 
        <div class="tab">
          <input id="tab-2" name="tab-group-1" type="radio" /> 
          <label for="tab-2">Système Requis</label> 
          <div class="content"> 

            <h3>Trollmageddon à besoins de quelques paramètres afin de fonctionner de façon optimale</h3>

            <p>
              <ul>
                <li>Wordpress 4.9.5 minimum</li>
                <li>Prise en charge du cache</li>
                <li>Bootstrap V4 dans le thème Wordpress que vous avez activé lien : <a href="https://getbootstrap.com/docs/4.0/getting-started/introduction/">Bootstrap</a> Il devra être chargé depuis le fichier function.php de votre thème</li>
                <li>Une connexion sécurisé à votre Base de Données</li>
              </ul>
            </p>

            <p>
              <ul>
                <li>PHP version 7.2 ou supérieur.</li>
                <li>MySQL version 5.6 ou supérieur</li>
                <li>HTTPS support</li>
              </ul>
            </p>

            <p>Si tout cela est bon vous pouvez aller dans la rubrique Paramètres du plugin Trollmageddon</p>

          </div> 
        </div> 
        <div class="tab">
          <input id="tab-3" name="tab-group-1" type="radio" /> 
          <label for="tab-3">Crédits</label> 
          <div class="content">

            <h3>Trollmageddon a été réalisés par des gentils Trolls</h3>

            <div class="identity">
              <img src="/wp-content/plugins/trollmageddon/assets/author/lg.jpg">
              <p style="float: left; padding: 1.5em 1em;">
              <strong>Laurent Grimaldi</strong><br>
              Créateur du Plugin<br>
              l.grimaldi.pro@outlook.com</p>
            </div>

            <div class="identity">
              <img src="/wp-content/plugins/trollmageddon/assets/author/sc.png">
              <p style="float: left; padding: 1.5em 1em;">
              <strong>Simon Chauchet</strong><br>
              Développeur<br>
              simonchauchet@hotmail.fr</p>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
.identity {
    width: 100%;
    height: 10em;
}
    
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
    float: left;
    width: 5em;
    margin: 2em 0 0.5em;
    border-radius: 4em;
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