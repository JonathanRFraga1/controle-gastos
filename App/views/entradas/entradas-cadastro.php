<main>
    <section class="panel">
        <div class="title"><h1><?= $this->title?></h1></div>
        <div class="controls-main">
            <div class="">
                <button class="bt bt-primary"
                    onclick="window.location.href='<?= HOME_URI?>/entradas'">
                    <i class="fas fa-chevron-left"></i>
                    Voltar
                </button>
            </div>

            <!-- <form role="search" class="busca" id="form-busca">
                <input type="search" id="busca" placeholder="Buscar pelo nickname ou pelo e-mail" autocomplete="off">
            </form> -->
        </div>

        <div class="table">
            <form method="post" id="form">
                <div>
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome">
                </div>

                <div>
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo">
                        <option value="rascunho">Rascunho</option>
                        <option value="debito">Débito</option>
                        <option value="credito">Crédito</option>
                        <option value="crediario">Crediário</option>
                        <option value="salario">Salário</option>
                    </select>
                </div>

                <div>
                    <label for="valor">Valor</label>
                    <input type="text" id="valor" name="valor" placeholder="R$ 0,00">
                </div>

                <div id="div-parcelas" class="hidden">
                    <label for="parcelas">Parcelas</label>
                    <input type="number" id="parcelas" name="parcelas" step="1" max="12" min="1">
                </div>

                <div id="div-vencimento" class="hidden">
                    <label for="vencimento">Vencimento</label>
                    <input type="text" id="vencimento" name="vencimento" placeholder="01/01">
                </div>

                <div>
                    <label for="data">Data da Compra</label>
                    <input type="date" id="data" name="data">
                </div>

                <hr>
                
                <div class="controls">
                    <a href="<?= HOME_URI?>/entradas" class="bt bt-primary">
                        <i class="fas fa-chevron-left"></i>
                        Voltar
                    </a>
                    <button class="bt bt-success">Salvar</button>
                </div>
            </form>
        </div>

    </section>
</main>

<script>
    $(document).ready(() => {
       $('#valor').mask('00000,00', {reverse: true})
       $('#vencimento').mask('00/00', {reverse: true})
    });

    $('#tipo').change(() => {
        let tipo = $('#tipo').val();
        if (tipo == 'credito' || tipo == 'crediario') {
            $('#div-parcelas').removeClass('hidden');
        } else {
            $('#div-parcelas').addClass('hidden');
            $('#parcelas').val('');
        }

        if (tipo == 'crediario') {
            $('#div-vencimento').removeClass('hidden');
        } else {
            $('#div-vencimento').addClass('hidden');
            $('#vencimento').val('');
        }
    });

    $('#form').submit(() => {
        let erro = false
        let nome = $('#nome').val();
        if (nome == '' || nome == null) {
            exibeNotificacao('Erro', 'O nome não pode ser vazio', 'error');
            erro = true;
        }

        let valor = $('#valor').val();
        if (valor == '' || valor == null) {
            exibeNotificacao('Erro', 'O valor não pode ser vazio', 'error');
            erro = true;
        }

        let tipo = $('#tipo').val();
        if (tipo == 'credito' || tipo == 'crediario') {
            let parcelas = $('#parcelas').val();
            if (parcelas == null || parcelas == '') {
                exibeNotificacao('Erro', 'O número de parcelas não pode ser vazio', 'error');
                erro = true;
            }
        }

        if (tipo == 'crediario') {
            let venc = $('#vencimento').val();
            if (venc == null || venc == '') {
                exibeNotificacao('Erro', 'A data de vencimento não pode ser vazia', 'error');
                erro = true;
            }
        }

        if (erro) {
            return false;
        }
    })
</script>
