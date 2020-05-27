<?php if (!defined('ABSPATH')) exit;
if(isset($PostID) && isset($_POST['tekcerto_certificado_salva'])) {
	$dados = array();
	$texto1 = stripslashes(sanitize_text_field($_POST['texto1']));
	$texto2 = stripslashes($_POST['texto2']);
	$texto3 = sanitize_text_field($_POST['texto3']);
	$texto4 = stripslashes($_POST['texto4']);
	$email_assunto = stripslashes($_POST['email_assunto']);
	$email_mensagem = stripslashes($_POST['email_mensagem']);
	$video_codigo = stripslashes($_POST['video_codigo']);
	$video_controles = stripslashes($_POST['video_controles']);
	$video_width = stripslashes($_POST['video_width']);
	$video_height = stripslashes($_POST['video_height']);

	$dados = array(
		'texto1' => $texto1,
		'texto2' => $texto2,
		'texto3' => $texto3,
		'texto4' => $texto4,
		'email_assunto' => $email_assunto,
		'email_mensagem' => $email_mensagem,
		'video_codigo' => $video_codigo,
		'video_controles' => $video_controles,
		'video_width' => $video_width,
		'video_height' => $video_height
	);
	update_post_meta($PostID, 'tekcerto_certificado_dados', serialize($dados));
}
