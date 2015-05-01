<?php
	// if ajax == true, ignore all php functions
	// and build the page with javascript on the client
	$ajax = isset($_GET['ajax_call']);
	$content = '';
	$image = '';

	if (!$ajax) :
		while (have_posts()): the_post();
			$content = $post->post_content;
			$image = has_post_thumbnail( $post->ID ) ?  get_the_post_thumbnail($post->ID) : '';
		endwhile;
	endif;
?>


<?php
	if (!$ajax) :
		get_header();
	endif;
?>

<div class="pure-g">
  <div class="offset-sm-1-24 pure-u-4-24" <?php if ($ajax) { echo 'ng-bind-html="page.content"'; } ?>>
		<?php echo $content; ?>
	</div>
  <div class="offset-sm-1-24 pure-u-18-24">
	<?php echo $image; ?>
  </div>
</div>

<?php 
if (!$ajax) :
	get_footer();
endif;
?>