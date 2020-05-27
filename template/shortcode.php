<?php
if (!defined('ABSPATH')) exit;
add_shortcode('TEKCERTO_CERTIFICADO', 'TEKCERTO_CERTIFICADO_ShortCode');
function TEKCERTO_CERTIFICADO_ShortCode($Id)
{
	ob_start();
	if (!isset($Id['id'])) {
		$TEKCERTO_CERTIFICADO_ID = "";
	} else {
		$TEKCERTO_CERTIFICADO_ID = $Id['id'];
	}

	$dadosPost = array('p' => $TEKCERTO_CERTIFICADO_ID, 'post_type' => 'tekcerto_certificado', 'orderby' => 'ASC');
	$loop = new WP_Query($dadosPost);

	while ($loop->have_posts()) : $loop->the_post();
		$post_id = get_the_ID();
		$dados = unserialize(get_post_meta(get_the_ID(), 'tekcerto_certificado_dados', true));
		if ($dados) {
			require('certificado.php');
		} else {
			echo "<h3> Nenhum vídeo de curso ou treinamento encontrado. </h3>";
		}

	endwhile;
	wp_reset_query();
	return ob_get_clean();
}
