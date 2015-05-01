<?php // single-linha.php
	
	$title = '';
	$description = '';
	$cols = 1;
	$mosaic;
	$tiles = [];

	while ( have_posts() ) : the_post();
		
		$title = $post->post_title;
		$description = $post->post_content;
	
		$colecoes = get_posts(array(
			'post_type'	=> 'colecao'
		));
		$filtered = [];

		foreach ($colecoes as $colecao) :
			
			$relation = get_field('linha_obj', $colecao->ID);

			if ( $relation[0]->ID === $post->ID && !isset( $filtered[$colecao->ID] ) ):
				$filtered[$colecao->ID] = $colecao;
			endif;
		
		endforeach;

		foreach ($filtered as $key => $colecao):

			$colecao_title = $colecao->post_title;
			$colecao_img_url = get_featured_image_url($colecao->ID);
			$colecao_link = home_url( '/' . $post->post_name . '/' . $colecao->post_name . '/' );
			$tile = new Mosaic_Tile($colecao_title, $colecao_img_url, $colecao_link, 'linha-featured-image', 'hero-title');
			array_push($tiles, $tile);

		endforeach;
		
		$cols = count($tiles) <= 2 ? 2 : 3;
		$mosaic = new Mosaic($tiles, $cols);

	endwhile; 

?>

<?php
	if (!$ajax) :
		get_header();
	endif;
?>

<div class="pure-g">

  <div class="offset-sm-1-24 pure-u-4-24">
    <div class="page-titles">
      <h1 class="h1">Linha <br><?php echo $title; ?></h1>
      <h2 class="sub-h1">Coleção 2015</h2>
    </div>

    <div class="ng-binding">
    	<p><?php echo $description; ?></p>
	</div>
  </div>

  <?php print($mosaic->render()); ?>

</div>

<?php 
if (!$ajax) :
	get_footer();
endif;
?>