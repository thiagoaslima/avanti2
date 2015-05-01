<?php
// customize-permalink.php
// based on http://wordpress.stackexchange.com/questions/61105/nested-custom-post-types-with-permalinks

add_filter( 'post_type_link', 'avanti_type_permalink', 1, 4 );
function avanti_type_permalink($post_link, $post, $leavename, $sample) {

	switch( $post->post_type ) {

        case 'linha':
       
            if ( isset( $post->post_name ) ) {
                // create the new permalink
                $post_link = home_url( user_trailingslashit( $post->post_name ) );
            }
        
	        break;


        case 'colecao':

        	$linha = get_field('linha_obj');
        	$linha_slug = $linha[0]->post_name;

        	$post_link = home_url( user_trailingslashit( $linha_slug . '/' . $post->post_name ) );

        	break;


        case 'tapete':

        	$colecao = get_field('colecao_obj');
        	$colecao_slug = $colecao[0]->post_name;

        	$linha = get_field('linha_obj', $colecao[0]->ID);
        	$linha_slug = $linha[0]->post_name;

        	$post_link = home_url( user_trailingslashit( $linha_slug . '/' . $colecao_slug . '/' . $post->post_name ) );

        	break;

    }

    return $post_link;
}