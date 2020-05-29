<?php if (!defined('ABSPATH')) exit; ?>
<div id="tekcerto-certificado-player-<?php echo $post_id ?>"></div>
<style>
    .tekcerto_certificado>* {
        width: 100%
    }

    .tekcerto_certificado>button,
    input {
        width: 100%
    }

    .error {
        color: red;
    }

    el.ok {
        color: green;
    }
</style>

<div id="tekcerto-certificado-dialog1-<?php echo $post_id ?>" title="Certificado" class="tekcerto_certificado" style="display: none;">
    <form id="tekcerto-form-<?php echo $post_id ?>">
        <fieldset>
            <label for="empresa">Empresa</label><br>
            <input type="text" name="empresa" required>
        </fieldset>
        <fieldset>
            <label for="nome">Nome Completo</label><br>
            <input type="text" name="nome" required><br>
            <label for="cpf">CPF</label><br>
            <input type="text" name="cpf" required><br>
            <label for="email">E-mail</label><br>
            <input type="email" name="email" required>
        </fieldset>
    </form>
    <div id="dialog-resposta-<?php echo $post_id ?>" style="display: none;">
    </div>
    <button id="dialog1-btn-<?php echo $post_id ?>">ENVIAR</button><br>
    <div id="dialog-loading-<?php echo $post_id ?>" style="display: none;">
        <img src="/wp-content/plugins/tekcerto-certificado/lib/img/loading.gif">
        Aguardando retorno...
    </div>
</div>


<script>
    jQuery(document).ready(function() {
        var dialog1 = jQuery('#tekcerto-certificado-dialog1-<?php echo $post_id ?>'),
            confirmar = jQuery('#dialog1-btn-<?php echo $post_id ?>'),
            resposta = jQuery('#dialog-resposta-<?php echo $post_id ?>'),
            carrega = jQuery('#dialog-loading-<?php echo $post_id ?>'),
            empresa = jQuery('input[name=empresa]'),
            player, formulario = jQuery('#tekcerto-form-<?php echo $post_id ?>');

        jQuery('input[name="cpf"]').mask('000.000.000-00');
        player = new YT.Player('tekcerto-certificado-player-<?php echo $post_id ?>', {
            height: '<?php echo $dados['video_height']; ?>',
            width: '<?php echo $dados['video_width']; ?>',
            videoId: '<?php echo $dados['video_codigo']; ?>',
            playerVars: <?php echo '{' . $dados['video_controles'] . '}'; ?>,
            events: {
                'onStateChange': function(event) {
                    if (event.data == YT.PlayerState.ENDED) {
                        dialog1.dialog({
                            resizable: false,
                            width: 400,
                            modal: true
                        });
                    }

                }
            }
        });

        confirmar.on('click', function() {
            var btnClose = jQuery(".ui-dialog-titlebar-close");
            if (confirmar.text() == 'GERAR OUTRO CERTIFICADO') {
                var emp = empresa.val();
                confirmar.text('ENVIAR');
                formulario.trigger('reset');
                empresa.val(emp);
                formulario.show();
                resposta.hide();
            } else if (formulario.valid()) {
                carrega.show();
                formulario.hide();
                confirmar.hide();
                btnClose.hide();
                jQuery.post({
                    type: 'POST',
                    url: '/wp-content/plugins/tekcerto-certificado/email.php',
                    data: formulario.serialize() + '&certificado=<?php echo $post_id ?>',
                    success: function(dados, status) {
                        switch (dados) {
                            case '0':
                                resposta.text('Falha ao enviar o e-mail.');
                            case '1':
                                resposta.text('Documento enviado com sucesso.');
                                break;
                            case '2':
                                resposta.text('Dados inválidos. Tente novamente.');
                                break
                            default:
                                resposta.text('Ocorreu um erro.');
                        }
                    },
                    complete: function(oi) {
                        confirmar.text('GERAR OUTRO CERTIFICADO');
                        confirmar.show();
                        carrega.hide();
                        resposta.show();
                        btnClose.show();
                    },
                    dataType: 'text'
                });
            }
        });


        jQuery('#tekcerto-form-<?php echo $post_id ?>').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                cpf: {
                    required: true
                },
                nome: {
                    required: true
                },
                cpf: {
                    required: true,
                    cpf: true
                }
            },
            messages: {
                email: {
                    required: "Informe o e-mail",
                },
                cpf: {
                    required: "Informe o CPF",
                },
                nome: {
                    required: "Informe seu nome completo",
                },
                empresa: {
                    required: "Informe o nome da empresa",
                },
                email: {
                    email: 'Informe um e-mail válido',
                    required: 'Informe o e-mail'
                }
            }
        });

        // cpf
        jQuery.validator.addMethod("cpf", function(valor, element) {
            valor = valor.replace(/[.-]/g, '');
            var soma, resto, i = 0,
                valido = true;
            soma = 0;
            if (valor == "00000000000") valido = false;
            for (i = 1; i <= 9; i++) soma = soma + parseInt(valor.substring(i - 1, i)) * (11 - i);
            resto = (soma * 10) % 11;
            if ((resto == 10) || (resto == 11)) resto = 0;
            if (resto != parseInt(valor.substring(9, 10))) valido = false;
            soma = 0;
            for (i = 1; i <= 10; i++) soma = soma + parseInt(valor.substring(i - 1, i)) * (12 - i);
            resto = (soma * 10) % 11;
            if ((resto == 10) || (resto == 11)) resto = 0;
            if (resto != parseInt(valor.substring(10, 11))) valido = false;
            return this.optional(element) || valido;
        }, "Informe um CPF válido");
    });
</script>