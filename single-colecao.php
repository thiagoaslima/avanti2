<?php // single-linha.php
	
	$title = '';
	$description = '';
	$cols = 1;
	$mosaic;
	$tiles = [];

	while ( have_posts() ) : the_post();
		
		$title = $post->post_title;
		$description = $post->post_content;
	
		$tapetes = get_posts(array(
			'nopaging' => true,
			'post_type'	=> 'tapete'
		));
		$filtered = [];

		foreach ($tapetes as $tapete) :
			
			$relation = get_field('colecao_obj', $tapete->ID);

			if ( $relation[0]->ID === $post->ID && !isset( $filtered[$tapete->ID] ) ):
				$filtered[$tapete->ID] = $tapete;
			endif;
		
		endforeach;

		foreach ($filtered as $key => $tapete):

			$tapete_title = $tapete->post_title;
			$tapete_img_url = get_featured_image_url($tapete->ID);
			$tapete_link = home_url( '/' . $post->post_name . '/' . $tapete->post_name . '/' );
			$tile = new Mosaic_Tile($tapete_title, $tapete_img_url, $tapete_link);
			array_push($tiles, $tile);

		endforeach;
		
		$cols = count($tiles) <= 2 ? 2 : 3;
		$mosaic = new Mosaic($tiles, $cols);

	endwhile; 

?>

<?php
	if (!$ajax) :
		get_header('colecao-featured-image', 'sub-h1');
	endif;
?>

<div class="pure-g">

  <div class="offset-sm-1-24 pure-u-4-24">
    <div class="page-titles">
      <h1 class="h1"><?php echo $title; ?></h1>
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