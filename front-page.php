<?php 
// if ajax == true, ignore all php functions
// and build the page with javascript on the client
$ajax = isset($_GET['ajax_call']);
$acf_field = 'fotos_capa';
$slides = array();
$gallery;

// organize global space
if (!$ajax) :

	// $slides = array();
	while (have_posts()) : the_post();
		$fotos = get_field($acf_field, $post->id);

		foreach ($fotos as $foto):
			$url = $foto['foto_capa']['sizes']['avanti-large'];
			$width = 1190;
			$height = 668;
			$content = sprintf('<div class="capa-link"><p><a href="%s">%s</a></p></div>', $foto['link_tapete'], $foto['texto_tapete']);

			array_push($slides, new Slide($url, $width, $height, $content));
		endforeach;
		
	endwhile;

endif;

$gallery = new Gallery($slides);

?>

<?php
if (!$ajax) :
	get_header();
endif;
?>

<div class="pure-g">
    <div class="pure-u-1-1" style="position: relative">

		<?php print($gallery->render()); ?>

        <div style="position: absolute; top: 4em; left: 0; right: 0; text-align:center">
            <h1 style="font-size: 24px; font-weight: 700; margin: 0 0 135px; letter-spacing: 0.3px">Avanti New Collection</h1>
            <p style="font-size: 16px; font-weight: 300; margin: 0">O estado da arte em tapetes.</p>
        </div>
    </div>
</div>

<?php get_footer(); ?>