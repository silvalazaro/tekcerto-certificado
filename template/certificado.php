<?php if (!defined('ABSPATH')) exit; ?>
<div id="player"></div>
<style>
    .tekcerto_certificado>* {
        width: 100%
    }

    .tekcerto_certificado>button,
    input {
        width: 100%
    }
</style>
<div id="dialog" title="Certificado" class="tekcerto_certificado" style="display: none;">
    <fieldset>
        <label>Empresa</label><br>
        <input type="text" name="empresa" placeholder="empresa">
    </fieldset>
    <fieldset>
        <label>Nome Completo</label><br>
        <input type="text" name="nome" placeholder="nome"><br>
        <label>CPF</label><br>
        <input type="text" name="cpf" placeholder="cpf"><br>
        <label>E-mail</label><br>
        <input type="text" name="email" placeholder="email">
    </fieldset>
    <button id="confirmar">CONFIRMAR</button>
</div>
<script>
    var tag = document.createElement('script'),
        player, done;
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    function onYouTubeIframeAPIReady() {
        var video = document.getElementById('video');
        player = new YT.Player('player', {
            height: '<?php echo $dados['video_height']; ?>',
            width: '<?php echo $dados['video_width']; ?>',
            videoId: '<?php echo $dados['video_codigo']; ?>',
            playerVars: <?php echo "{$video_controles}"; ?>,
            events: {
                'onStateChange': onPlayerStateChange
            }
        });
    }

    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.ENDED) {
            //TODO
        }
        jQuery("#dialog").dialog({
            resizable: false,
            height: 'auto',
            width: 400,
            modal: true
        });
        jQuery("#confirmar").onclick(function() {
            jQuery.post("ajax/test.html", function(data) {
               // jQuery.(".result").html(data);
            });
        });
    }
</script>