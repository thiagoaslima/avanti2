<?php
// rewrite-rules.php
// based on http://wordpress.stackexchange.com/questions/61105/nested-custom-post-types-with-permalinks

add_action('init', 'avanti_rewrite_rules');
function avanti_rewrite_rules() {

	$linhas = get_posts( array('post_type' => 'linha') );

	foreach ($linhas as $linha) :
		$slug = $linha->post_name;

		// tapetes
	    add_rewrite_rule(
	            $slug . '/([^/]*)/([^/]*)/?', 
	            'index.php?post_type=tapete&name=$matches[2]', 
	            'top'
	    );

		// collections
	    add_rewrite_rule(
	            $slug . '/([^/]*)/?', 
	            'index.php?post_type=colecao&name=$matches[1]', 
	            'top'
	    );

		// linha
	    add_rewrite_rule(
	            $slug . '/?', 
	            'index.php?post_type=linha&name=' . $slug, 
	            'top'
	    );

	endforeach;

}