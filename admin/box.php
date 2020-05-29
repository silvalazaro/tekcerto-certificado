<?php if (!defined('ABSPATH')) exit;

$secao1 = '';
$secao2 = '';
$secao3 = '';
$secao4 = '';
$secao5 = '';
$email_assunto = '';
$email_mensagem = '';
$video_codigo = '';
$video_controles = 'controls:{1}';
$video_width = '300px';
$video_height = '200px';

$dados = unserialize(get_post_meta($post->ID, 'tekcerto_certificado_dados', true));
if ($dados) {
    $secoes = apply_filters('the_content', $post->post_content);
    $secoes = strip_tags($secoes, '<br>');
    $secoes = preg_split('/;tekcerto_certificado;/', $secoes);

    $secao1 =  $secoes[0];
    $secao2 = $secoes[1];
    $secao3 = $secoes[2];
    $secao4 = $secoes[3];
    $secao5 = $secoes[4];
    $email_assunto = $dados['email_assunto'];
    $email_mensagem = $dados['email_mensagem'];
    $video_codigo = $dados['video_codigo'];
    $video_controles = $dados['video_controles'];
    $video_width = $dados['video_width'];
    $video_height = $dados['video_height'];

    $email_mensagem = unserialize(get_post_meta($post->ID, 'tekcerto_certificado_mensagem', true));
}
?>
<div class="alert alert-primary" role="alert">
    <h4><span class="badge badge-secondary">Certificado / Dados</span></h4>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Seção 1</span>
        </div>
        <textarea class="form-control" aria-label="secao 1" name="secao1" placeholder="Texto da seção 1"><?php echo $secao1; ?></textarea>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Seção 2</span>
        </div>
        <textarea class="form-control" aria-label="secao 2" name="secao2" placeholder="Texto da seção 2"><?php echo $secao2; ?></textarea>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Seção 3</span>
        </div>
        <textarea class="form-control" aria-label="secao 3" name="secao3" placeholder="Texto da seção 3"><?php echo $secao3; ?></textarea>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Seção 4</span>
        </div>
        <textarea class="form-control" aria-label="secao 4" name="secao4" placeholder="Texto da seção 4"><?php echo $secao4; ?></textarea>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Imagem</span>
        </div>
        <input id="secao5" name="secao5" class="form-control" type="text" placeholder="URL absoluta da imagem" value="<?php echo $secao5; ?>">
    </div>
</div>
<div class="alert alert-primary">
    <h4><span class="badge badge-secondary">E-mail / Dados</span></h4>
    <div class="form-group">
        <label for="assunto">Assunto</label>
        <input id="email_assunto" name="email_assunto" class="form-control" type="text" placeholder="Informe o assunto" value="<?php echo $email_assunto; ?>">
    </div>
    <div class="form-group">
        <label for="mensagem">Mensagem [Aceita HTML]</label>
        <textarea maxlength="200" name="email_mensagem" class="form-control" aria-label="mensagem"><?php echo $email_mensagem; ?></textarea>
    </div>
</div>
<!-- Vídeo -->
<div class="alert alert-primary">
    <h4><span class="badge badge-secondary">Vídeo / Dados</span></h4>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Código</span>
        </div>
        <input name="video_codigo" class="form-control" type="text" placeholder="Código Youtube" value="<?php echo $video_codigo; ?>">
        <div class="input-group-prepend">
            <span class="input-group-text">Height</span>
        </div>
        <input name="video_height" class="form-control" type="text" placeholder="frame height" value="<?php echo $video_height; ?>">
        <div class="input-group-prepend">
            <span class="input-group-text">Width</span>
        </div>
        <input name="video_width" class="form-control" type="text" placeholder="frame width" value="<?php echo $video_width; ?>">
    </div>
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">playerVars / API Youtube</span>
            </div>
            <input name="video_controles" class="form-control" type="text" placeholder="Parâmetros" value="<?php echo $video_controles; ?>">
        </div>
    </div>
</div>
<input type="hidden" name="tekcerto_certificado_salva" value="tekcerto_certificado_salva" />