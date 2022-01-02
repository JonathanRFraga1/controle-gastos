
/**
 * Função responsavel pela exibição da notificação
 *
 * @param {string} title titulo da notificação
 * @param {string} content conteúdo da notificação
 * @param {string} type tipo da notificação
 */
function exibeNotificacao(title, content, type) {

    let id = 'notification-alert-' + parseInt(Math.random() * (1000 - 1) + 1);

    let panel = `
        <div class="notification ${type}" id="${id}">
            <p class="title" role="alert">${title}</p>
            <p role="alert">${content}</p>
        </div>`;


        
    $('#notification-panel').append(panel);

    setTimeout(() => {
        $(`#${id}`).addClass('show');
    }, 500);

    setTimeout(() => {
        $(`#${id}`).removeClass('show');
        setTimeout(() => {
            $(`#${id}`).remove();
        }, 600);
    }, 3000);
}

/**
 * Função responsável por ocultar o menu ao clicar fora dele
 */
window.addEventListener('click', function(e){  
    if ($('#main-menu').hasClass('show')) { 
        if (
            !document.getElementById('main-menu').contains(e.target) 
            && !document.getElementById('bt-main-menu').contains(e.target)
        ){
            $('#main-menu').removeClass('show')
        }
    }
});
