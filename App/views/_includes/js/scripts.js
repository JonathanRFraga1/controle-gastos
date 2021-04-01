
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

definePaginaExibicao();

window.onhashchange = () => {
  definePaginaExibicao();
}

$('a').click((event) => {
  event.preventDefault();
  let hash = event.target.href
  hash = hash.substring(hash.indexOf('#') + 1, hash.length);
  location.hash = hash;
});

function registraServiceWorker() {
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('service-worker.js')
      .then(function (registration) {
        console.log('Registration successful, scope is:', registration.scope);
      })
      .catch(function (error) {
        console.log('Service worker registration failed, error:', error);
      });
  }
}

function definePaginaExibicao() {
  let hash = location.hash;
  let page = '';

  if (hash == '') {
    page = 'home';
    location.hash = '#home'
  } else {
    page = hash.substring(hash.indexOf('#') + 1, hash.length);
  }
  carregaPagina(page);
}

function carregaPagina(pagina) {
  $.ajax({
    url: `/pages/${pagina}.html`,
    success: function (data) {
      $("#content").html(data);
    },
    error: function (data) {
      console.error(data);
      carregaPaginaErro();
    }
  });
}

function carregaPaginaErro() {
  $.ajax({
    url: `/pages/404.html`,
    success: function (data) {
      $("#content").html(data);
    },
    error: function (data) {
      console.error(data);
    }
  });
}

function isLogged() {
  let user = localStorage.getItem("user");
  if (user != null) {
    return true;
  }
  return false;
}
