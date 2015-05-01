<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
		<p class="browsehappy">Você está utilizando um navegador <strong>desatualizado</strong>. Por favor, <a href="http://browsehappy.com/?locale=pt-br">atualize o seu programa</a> para uma melhor experiência.</p>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/es5-shim/4.1.1/es5-shim.min.js"></script>
	<![endif]-->
	<?php wp_head(); ?>

	<script>
	  (function(d) {
	    var config = {
	      kitId: 'aus7jye',
	      scriptTimeout: 3000
	    },
	    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
	  })(document);
	</script>

</head>

<body ng-app="app" ng-strict-di <?php body_class(); ?> ng-controller="headerController" ng-class="{'is-home': isHome()}">
	
	<div class="svg-icons" style="display:none">
		<?php include_once(get_template_directory_uri() . '/svg/icons.svg'); ?>
	</div>
	
	<header class="page-header pure-g ng-scope" ng-controller="headerController">
		<div class="logo pure-u-4-24 ng-scope">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ng-scope">
				<?php include_once(get_template_directory_uri() . '/svg/avanti-logo-horiz.svg'); ?>
			</a>
		</div>

		<nav class="menu-global pure-u-16-24 ng-scope">
			<?php wp_nav_menu(array(
				'menu' => 'Primary Menu',
				'container' => false
			)); ?>
		</nav>

		<ul class="menu-2 pure-u-4-24">
		    <li>
		        <a href='http://www.avantionline.com.br/'>loja online</a>
		    </li>
		    <li>
		        <form class="page-search pure-form">
		            <input type="search" id="site-search" name="site-search">
		            <label for="site-search">
		                <svg class="icon icon-search">
		                    <use xlink:href="#search" />
		                </svg>
		            </label>
		        </form>
		    </li>
		    <li>
		        <a href="https://www.facebook.com/avantitapetespap">
		            <svg class='icon icon-facebook'>
		                <use xlink:href='#facebook' />
		            </svg>
		        </a>
		    </li>
		    <li>
		        <a href="https://instagram.com/avantitapetes/">
		            <svg class='icon icon-instagram'>
		                <use xlink:href='#instagram' />
		            </svg>
		        </a>
		    </li>
		</ul>
	</header>

	<div class="wrapper">
		<div ng-view="" autoscroll="-128" class="ng-scope">