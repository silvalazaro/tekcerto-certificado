<?php if (!defined('ABSPATH')) exit;

$texto1 = '';
$texto2 = '';
$texto3 = '';
$texto4 = '';
$email_assunto = '';
$email_mensagem = '';
$video_codigo = '';
$video_controles = '';
$video_width = '300px';
$video_height = '200px';

$dados = unserialize(get_post_meta($post->ID, 'tekcerto_certificado_dados', true));
if ($dados) {
    $texto1 =  $dados['texto1'];
    $texto2 = $dados['texto2'];
    $texto3 = $dados['texto3'];
    $texto4 = $dados['texto4'];
    $email_assunto = $dados['email_assunto'];
    $email_mensagem = $dados['email_mensagem'];
    $video_codigo = $dados['video_codigo'];
    $video_controles = $dados['video_controles'];
    $video_width = $dados['video_width'];
    $video_height = $dados['video_height'];
}
?>
<div class="alert alert-primary" role="alert">
    <h4><span class="badge badge-secondary">Certificado / Dados</span></h4>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Texto 1</span>
        </div>
        <textarea class="form-control" aria-label="Texto 1" name="texto1"><?php echo $texto1; ?></textarea>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Texto 2</span>
        </div>
        <textarea class="form-control" aria-label="Texto 2" name="texto2"><?php echo $texto2; ?></textarea>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Texto 3</span>
        </div>
        <textarea class="form-control" aria-label="Texto 3" name="texto3"><?php echo $texto3; ?></textarea>
    </div>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Texto 4</span>
        </div>
        <textarea class="form-control" aria-label="Texto 4" name="texto4"><?php echo $texto4; ?></textarea>
    </div>
</div>
<div class="alert alert-primary">
    <h4><span class="badge badge-secondary">E-mail / Dados</span></h4>
    <div class="form-group">
        <label for="assunto">Assunto</label>
        <input id="email_assunto" name="email_assunto" class="form-control" type="text" placeholder="Informe o assunto" value="<?php echo $email_assunto; ?>">
    </div>
    <div class="form-group">
        <label for="mensagem">Mensagem</label>
        <textarea name="email_mensagem" class="form-control" aria-label="mensagem"><?php echo $email_mensagem; ?></textarea>
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
            <input name="video_controles" class="form-control" type="text" placeholder="Controls Youtube" value="<?php echo $video_controles; ?>">
        </div>
    </div>
</div>
<input type="hidden" name="tekcerto_certificado_salva" value="tekcerto_certificado_salva" />