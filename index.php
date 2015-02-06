<?php
session_start();

require_once('common.php');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Eulexis - lemmatiseur de grec ancien | Boîte à outils Biblissima</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- metas -->
  <meta name="description" content="Eulexis permet de lemmatiser ou fléchir un texte en grec ancien et de rechercher dans des dictionnaires de grec ancien en plusieurs langues">
  <meta property="twitter:url" content="http://outils.biblissima.fr/eulexis">
  <meta property="twitter:title" content="Eulexis : lemmatiseur de grec ancien">
  <meta property="twitter:card" content="summary">
  <meta property="twitter:description" content="Eulexis permet de lemmatiser ou fléchir un texte en grec ancien et de rechercher dans des dictionnaires de grec ancien en plusieurs langues">
  <meta property="og:site_name" content="Eulexis | Boîte à outils Biblissima">
  <meta property="og:url" content="http://outils.biblissima.fr/eulexis">
  <meta property="og:title" content="Eulexis : lemmatiseur de grec ancien">
  <meta property="og:type" content="website">
  <meta property="og:description" content="Eulexis permet de lemmatiser ou fléchir un texte en grec ancien et de rechercher dans des dictionnaires de grec ancien en plusieurs langues">
  <script type="application/ld+json">
    {
      "@context" : "http://schema.org",
      "@type" : "WebApplication",
      "license": "http://creativecommons.org/licenses/by-nc/4.0/",
      "name" : "Eulexis",
      "image" : "http://outils.biblissima.fr/eulexis/img/greek-scribe-small.png",
      "url" : "http://outils.biblissima.fr/eulexis",
      "description" : "Eulexis permet de lemmatiser ou fléchir un texte en grec ancien et de rechercher dans des dictionnaires de grec ancien en plusieurs langues",
      "provider" : {
        "@type" : "Organization",
        "name" : "Equipex Biblissima"
      },
      "creator" : [
      {
        "@type" : "Person",
        "name" : "Philippe Verkerk"
      }],
      "contributor" : [
      {
        "@type" : "Person",
        "name" : "Régis Robineau"
      }]
    }
    </script>
  
  <!-- css -->
  <link href="<?php echo $staticBaseUrl; ?>libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $staticBaseUrl; ?>css/style.css" rel="stylesheet">
  <link href="http://outils.biblissima.fr/collatinus/css/style.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  
  <!-- Fonts 
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,latin-ext" rel="stylesheet">-->
  
  <link rel="shortcut icon" href="favicon.ico">
  <link rel="icon" type="image/png" href="favicon.png">
    
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <div class="navbar navbar-default navbar-static-top">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand logo-biblissima pfm" href="http://www.biblissima-condorcet.fr" title="Site web de Biblissima"><span>biblissima</span></a>
      <p class="navbar-text">
        <a href="http://outils.biblissima.fr" title="Accueil Boîte à outils Biblissima">Boîte à outils</a>
      </p>
    </div>
  </div>
  
  <!-- jumbotron -->
  <div class="jumbotron">
    <div class="container">
      <div class="pull-left hidden-xs logo"></div>
      <h1>Eulexis <small class="text-danger">[bêta]</small></h1>
      <p>Lemmatiseur de grec ancien</p>
      <div class="btn-container">
        <a class="btn btn-default btn-github" href="https://github.com/biblissima/eulexis"><span class="fa fa-github"></span>&nbsp; Eulexis sur Github</a>
      </div>
    </div>
  </div><!-- /.jumbotron -->
  
   <div class="container">
      
    <div class="well">
      <p><em>Eulexis</em> est un <strong>lemmatiseur</strong> de textes grecs.</p>
      <p><strong class="text-danger">Cette application est actuellement en version bêta</strong>. Elle est mise à disposition sans aucune garantie et reste soumise à corrections et améliorations.</p>
      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-info">Plus d'infos</button>
    </div>

    <!-- Recherche -->
    <form method="post" role="form" class="form-lemme">
      <label for="recherche_lemme" class="main-label">Rechercher un lemme</label>
      <div class="form-group form-inline">
        <input type="text" name="lemme" id="recherche_lemme" value="" class="form-control" size="40" placeholder="Entrez un mot grec...">
        
        <label for="dicos">&nbsp;dans &nbsp;</label>
        <select name="dicos" id="dicos">
          <option value="les trois dicos">les trois dicos</option>
          <option value="les LSJ et Pape">les LSJ et Pape</option>
          <option value="les Pape et Bailly">les Pape et Bailly</option>
          <option value="les LSJ et Bailly">les LSJ et Bailly</option>
          <option value="le LSJ">le LSJ</option>
          <option value="le Pape">le Pape</option>
          <option value="le Bailly">le Bailly</option>
        </select>
        
        <input type="submit" value="Rechercher" class="btn btn-success">
        
        <input type="hidden" name="consultation" value="true">
      </div>
    </form>
    
    <!-- Flexion -->
    <form method="post" role="form" class="form-lemme">
      <label for="flexion_lemme" class="main-label">Fléchir un lemme</label>
      <div class="form-group form-inline">
        <input type="text" name="lemme" id="flexion_lemme" value="" class="form-control" size="40" placeholder="Entrez un mot grec...">
        
        <input type="submit" value="Fléchir" class="btn btn-success">
        
        <input type="hidden" name="flexion" value="true">
      </div>
    </form>
    
    <!-- Traitement texte -->
    <form method="post" role="form" class="form-lemme">
      <label for="lemmatiser_texte" class="main-label">Lemmatiser un texte grec</label>
      <div class="form-group">
        <textarea name="grec" id="lemmatiser_texte" value="" class="form-control" rows="6" cols="80" placeholder="Entrez un texte grec..."></textarea>
      </div>
     
      <input type="submit" name="action" value="Lemmatiser" class="btn btn-success">
      <input type="checkbox" name="exacte"> Formes exactes seulement
      <button type="reset" name="action" value="Effacer" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove-circle"></span> Effacer</button>
      
      <input type="hidden" name="lemmatisation" value="true">
      <input type="hidden" name="lemme" value="">
      
    </form>
    
    <div id="results"></div>
    
    <div class="well">
      <h3>Crédits</h3>
      <p>Un grand merci à Philipp Roelli, André Charbonnet, Peter J. Heslin, Yves Ouvrard, Eduard Frunzeanu et Régis Robineau.</p>
      <ul>
        <li>Le LSJ est de <a href="http://www.mlat.uzh.ch/MLS/">Philipp Roelli</a>, revu et corrigé par
            <a href="http://chaerephon.e-monsite.com/medias/files/bailly.html">Chaeréphon (André Charbonnet)</a></li>
        <li>Le Pape est de <a href="http://www.mlat.uzh.ch/MLS/">Philipp Roelli</a></li>
        <li>L'abrégé du Bailly est de <a href="http://chaerephon.e-monsite.com/medias/files/bailly.html">Chaeréphon (André Charbonnet)</a></li>
        <li>La lemmatisation et la flexion ont été possibles grâce aux fichiers de <a href="https://community.dur.ac.uk/p.j.heslin/Software/Diogenes/">Diogenes</a> et de <a href="http://www.perseus.tufts.edu/">Perseus</a>.</li>
      </ul>
    </div>
    
    <!-- Bouton scrollTop -->
    <div id="scrollToTop"><a href="#"><span class="glyphicon glyphicon-circle-arrow-up"></span></a></div>
  
  </div><!-- /.container -->
  
  <!-- Fenetre modal-error -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-error">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-warning">
            Veuillez saisir un texte dans un des champs.
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <!-- Fenetre modal-info -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-info">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span></button>
        </div>
        <div class="modal-body">
          <p>Les dictionnaires utilisés par l'application sont :</p>
          <ul>
            <li>le <abbr title="Liddel-Scott-Jones">LSJ</abbr> (1940) : Grec &rarr; Anglais</li>
            <li>le Pape (1880) : Grec &rarr; Allemand</li>
            <li>le Bailly (Abr. 1919) : Grec &rarr; Français
                <ul>
                  <li><a href="http://www.tabularium.be/bailly/">Le Bailly en mode image sur Tabularium</a></li>
                  <li><a href="http://remacle.org/bloodwolf/vocabulaire/table.htm"> Le Bailly sur Remacle.org (incomplet)</a></li>
                </ul>
            </li>
          </ul>
          <p>Le programme ne tient pas compte des accents et esprits.</p>
          <p>Le lemme peut être écrit en grec ou en utilisant l'alphabet latin. Dans ce cas, on utilisera les équivalences suivantes qui sont compatibles avec le betacode :</p>
  <table>
  <tr><td>&nbsp;a&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;α&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;i&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ι&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;r&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ρ&nbsp;</td></tr>
  <tr><td>&nbsp;b&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;β&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;k&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;κ&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;s&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;σ, ς&nbsp;</td></tr>
  <tr><td>&nbsp;g&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;γ&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;l&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;λ&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;t&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;τ&nbsp;</td></tr>
  <tr><td>&nbsp;d&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;δ&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;m&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;μ&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;u&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;υ&nbsp;</td></tr>
  <tr><td>&nbsp;e&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ε&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;n&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ν&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;f&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;φ&nbsp;</td></tr>
  <tr><td>&nbsp;z&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ζ&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;c&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ξ&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;x&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;χ&nbsp;</td></tr>
  <tr><td>&nbsp;h&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;η&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;o&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ο&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;y&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ψ&nbsp;</td></tr>
  <tr><td>&nbsp;q&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;θ&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;p&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;π&nbsp;</td>
  <td>&nbsp;&nbsp;</td><td>&nbsp;w&nbsp;</td><td>&nbsp;⇒&nbsp;</td><td>&nbsp;ω&nbsp;</td></tr>
  </table>
  <br />
  <p>Sur Mac, le clavier "Grec Polytonique" est assez pratique.<br />
  On trouvera <a href='doc/Cl_gr_polyt.pdf'>ici le plan de ce clavier</a>.</p>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <footer class="site-footer" role="contentinfo">
    <div class="container">

        <div class="col-sm-10">
          <p class="navbar-text"><a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" style="border-width:0" src="<?php echo $staticBaseUrl; ?>img/cc-by-nc-4.0-88x31.png" /></a>&nbsp; <a rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/">Creative Commons Attribution-NonCommercial 4.0 International License</a><br /><small>Philippe Verkerk, 2014 &ndash; Programme mis à votre disposition sans aucune garantie, mais avec l'espoir qu'il vous sera utile.</small></p>
        </div>
        
        <div class="col-sm-2">
          <p class="navbar-text text-muted"><span class="glyphicon glyphicon-envelope"></span>&nbsp;<a href="mailto:&#99;&#111;&#108;&#108;&#97;&#116;&#105;&#110;&#117;&#115;&#64;&#98;&#105;&#98;&#108;&#105;&#115;&#115;&#105;&#109;&#97;&#45;&#99;&#111;&#110;&#100;&#111;&#114;&#99;&#101;&#116;&#46;&#102;&#114;">Feedback</a></p>
        </div>
      
    </div>
  </footer>
  
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="<?php echo $staticBaseUrl; ?>libs/jquery-1.10.1.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="<?php echo $staticBaseUrl; ?>libs/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/eulexis.min.js"></script>
  <script src="js/lat_grc.json"></script>
  
  <!-- Piwik -->
  <script type="text/javascript"> 
    var _paq = _paq || [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
      var u=(("https:" == document.location.protocol) ? "https" : "http") + "://piwik.biblissima-condorcet.fr/";
      _paq.push(['setTrackerUrl', u+'piwik.php']);
      _paq.push(['setSiteId', 4]);
      var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
      g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
  </script>
  <noscript><img src="http://piwik.biblissima-condorcet.fr/piwik.php?idsite=4" style="border:0" alt="" /></noscript>
</body>
</html>