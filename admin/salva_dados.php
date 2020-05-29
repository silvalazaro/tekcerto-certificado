<?php if (!defined('ABSPATH')) exit;
if (isset($PostID) && isset($_POST['tekcerto_certificado_salva'])) {
	$dados = array();
	$secao1 = stripslashes($_POST['secao1']);
	$secao2 = stripslashes($_POST['secao2']);
	$secao3 = stripslashes($_POST['secao3']);
	$secao4 = stripslashes($_POST['secao4']);
	$secao5 = stripslashes($_POST['secao5']);
	$email_assunto = stripslashes($_POST['email_assunto']);
	$email_mensagem = stripslashes($_POST['email_mensagem']);
	$video_codigo = stripslashes($_POST['video_codigo']);
	$video_controles = stripslashes($_POST['video_controles']);
	$video_width = stripslashes($_POST['video_width']);
	$video_height = stripslashes($_POST['video_height']);

	$dados = array(
		'email_assunto' => $email_assunto,
		'video_codigo' => $video_codigo,
		'video_controles' => $video_controles,
		'video_width' => $video_width,
		'video_height' => $video_height
	);
	$secoes = array(
		'secao1' => $secao1,
		'secao2' => $secao2,
		'secao3' => $secao3,
		'secao4' => $secao4,
		'secao5' => $secao5,
	);
	update_post_meta($PostID, 'tekcerto_certificado_dados', serialize($dados));
	update_post_meta($PostID, 'tekcerto_certificado_mensagem', serialize($email_mensagem));

	remove_action('save_post', array(&$this, 'salva_meta_box'), 9);
	$post = array(
		'ID' => $PostID,
		'post_content' => implode($secoes, ';tekcerto_certificado;')
	);
	wp_update_post($post);
	add_action('save_post', array(&$this, 'salva_meta_box'), 9);
}
