<?php
require_once('../../../wp-load.php');

function TEKCERTO_CERTIFICADO_VALIDAR_CPF($cpf)
{
    if (empty($cpf)) {
        return false;
    }

    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    if (strlen($cpf) != 11) {
        return false;
    } else if (
        $cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999'
    ) {
        return false;
    } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return $cpf;
    }
}


$empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_STRING);
$nome =  filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_CALLBACK, array('options' => 'TEKCERTO_CERTIFICADO_VALIDAR_CPF'));
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$certificado = filter_input(INPUT_POST, 'certificado', FILTER_SANITIZE_NUMBER_INT);
$data = date('d/m/Y');
$hora = date('H:i');


$post = get_post($certificado);
$secoes = apply_filters('the_content', $post->post_content);
$secoes = strip_tags($secoes, '<br>');
$secoes = preg_split('/;tekcerto_certificado;/', $secoes);

require_once('documento.php');

if ($empresa && $nome && $cpf && $email && $certificado && $secoes) {
    $dados = unserialize(get_post_meta($certificado, 'tekcerto_certificado_dados', true));
    $email_mensagem = unserialize(get_post_meta($certificado, 'tekcerto_certificado_mensagem', true));
    $result = wp_mail($email, $dados['email_assunto'], $email_mensagem, array('Content-Type: text/html; charset=UTF-8'), ['Certificado.pdf']);
    wp_delete_file('Certificado.pdf');
    echo  $result;
} else {
    echo 2;
}
