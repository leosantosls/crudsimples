/**
* Template Name: NiceAdmin - v2.2.2
* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
*/
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Search bar toggle
   */
  if (select('.search-bar-toggle')) {
    on('click', '.search-bar-toggle', function(e) {
      select('.search-bar').classList.toggle('search-bar-show')
    })
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  /**
   * Initiate quill editors
   */
  if (select('.quill-editor-default')) {
    new Quill('.quill-editor-default', {
      theme: 'snow'
    });
  }

  if (select('.quill-editor-bubble')) {
    new Quill('.quill-editor-bubble', {
      theme: 'bubble'
    });
  }

  if (select('.quill-editor-full')) {
    new Quill(".quill-editor-full", {
      modules: {
        toolbar: [
          [{
            font: []
          }, {
            size: []
          }],
          ["bold", "italic", "underline", "strike"],
          [{
              color: []
            },
            {
              background: []
            }
          ],
          [{
              script: "super"
            },
            {
              script: "sub"
            }
          ],
          [{
              list: "ordered"
            },
            {
              list: "bullet"
            },
            {
              indent: "-1"
            },
            {
              indent: "+1"
            }
          ],
          ["direction", {
            align: []
          }],
          ["link", "image", "video"],
          ["clean"]
        ]
      },
      theme: "snow"
    });
  }

  /**
   * Initiate TinyMCE Editor
   */

  var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;

  /**
   * Initiate Bootstrap validation check
   */
  var needsValidation = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(needsValidation)
    .forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })

  /**
   * Autoresize echart charts
   */
  const mainContainer = select('#main');
  if (mainContainer) {
    setTimeout(() => {
      new ResizeObserver(function() {
        select('.echart', true).forEach(getEchart => {
          echarts.getInstanceByDom(getEchart).resize();
        })
      }).observe(mainContainer);
    }, 200);
  }

})();

const Toast = Swal.mixin({
  toast: true,
  position: 'top-right',
  customClass: { popup: 'colored-toast' },
  showConfirmButton: false,
  showCloseButton: true,
  timer: 4000,
  timerProgressBar: true
})

function validationField(field, name){
  if($('#'+field).val() == ''){
    Toast.fire({
      icon: 'error',
      title: 'O campo '+name+' é obrigatório'
    })

    $('#formulario').addClass('was-validated');
    $('#'+field).focus()
    return false;
  }

  return true;
}

function alertPersona(type, msg, time = 3000){
  Toast.fire({
    icon: type,
    title: msg,
    timer: time
  })
}

function modalAguardando(title = '', body = '', static = false){
  $('#verticalycentered').find('.modal-title').html(title);
  $('#verticalycentered').find('.modal-body').html(body);
  if(static){
    $('#verticalycentered').attr('data-bs-backdrop','static');
    $('#verticalycentered').find('.btn-close').attr('disabled', '');
    $('#verticalycentered').find('.modal-footer').html('');
  }
  
  $('#verticalycentered').modal('show');
}

function loopAguardando(text){
  return '<div class="load-2">'+
          '<p>'+text+'</p>'+
          '<div class="line"></div>'+
          '<div class="line"></div>'+
          '<div class="line"></div>'+
        '</div>';
}

function ativaMenuFucos(cod, desc){
    $('#'+cod).addClass('active');
    $('#'+cod).removeClass('collapsed');
    if(desc != ''){
      $('#'+desc+'-nav').addClass('show'); 
      $('#'+desc+'-link').removeClass('collapsed'); 
    }
}

// Select
$( document ).ready(function() {
  $('.form-control').selectpicker();
});

// DataTable
$(document).ready(function() {
  var table = $('#datatable').DataTable({
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'collection',
              text: 'Exportar Dados',
              buttons: [
                  {
                      extend: 'copy',
                      text: 'Copiar',
                      exportOptions: {
                          columns: ':visible:not(.not-export-col)'
                      }
                  },{
                      extend: 'csvHtml5',
                      text: 'CSV',
                      fieldSeparator: ';',
                      exportOptions: {
                          columns: ':visible:not(.not-export-col)'
                      }
                  },{
                      extend: 'excel',
                      text: 'Excel',
                      charset: 'UTF-8',
                      bom: true,
                      exportOptions: {
                          columns: ':visible:not(.not-export-col)'
                      }
                  },
                  {
                      extend: 'pdf',
                      text: 'PDF',
                      charset: 'UTF-8',
                      bom: true,
                      exportOptions: {
                          columns: ':visible:not(.not-export-col)'
                      }
                  }
              ]
          },
          {
              extend: 'collection',
              text: 'Pesquisa / Visualização',
              buttons: [
                  {
                      extend: 'searchPanes',
                      text: 'Painel de Buscas',
                      config: {
                          cascadePanes: true,
                          show: true,
                          viewTotal: true
                      }
                  },
                  {
                      extend: 'colvis',
                      text: 'Ver/Esconder colunas',
                      collectionLayout: 'two-column'
                  },
                  'pageLength'
              ]
          },
          {
              text: ' + Novo Registro',
              addClass: 'btn-group',
              action: function ( e, dt, node, conf ) {
                  novoRegistro();
              }
          },
      ],
      lengthMenu: [
          [ 25, 50, 100, 500],
          [ '25 resultados', '50 resultados', '100 resultados', '500 resultados']
      ],
      columnDefs: [
          { "orderable": false, "targets": [0] },
          { "targets": 'not-show-col',"visible": false },
          {
            searchPanes:{
                show: true,
            },
            targets: 'Search'
          },
      ],
      fixedHeader: true,
      autoWidth: false,
      info: false,
      order: [[ 1, "asc" ]],
      language: {
          "emptyTable": "Nenhum registro encontrado",
          "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 até 0 de 0 registros",
          "infoFiltered": "(Filtrados de _MAX_ registros)",
          "infoThousands": ".",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "zeroRecords": "Nenhum registro encontrado",
          "search": "Pesquisar",
          "paginate": {
              "next": "Próximo",
              "previous": "Anterior",
              "first": "Primeiro",
              "last": "Último"
          },
          "aria": {
              "sortAscending": ": Ordenar colunas de forma ascendente",
              "sortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
              "rows": {
                  "_": "Selecionado %d linhas",
                  "1": "Selecionado 1 linha"
              },
              "cells": {
                  "1": "1 célula selecionada",
                  "_": "%d células selecionadas"
              },
              "columns": {
                  "1": "1 coluna selecionada",
                  "_": "%d colunas selecionadas"
              }
          },
          "buttons": {
              "copySuccess": {
                  "1": "Uma linha copiada com sucesso",
                  "_": "%d linhas copiadas com sucesso"
              },
              "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
              "colvis": "Visibilidade da Coluna",
              "colvisRestore": "Restaurar Visibilidade",
              "copy": "Copiar",
              "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
              "copyTitle": "Copiar para a Área de Transferência",
              "csv": "CSV",
              "excel": "Excel",
              "pageLength": {
                  "-1": "Mostrar todos os registros",
                  "_": "Mostrar %d registros"
              },
              "pdf": "PDF",
              "print": "Imprimir",
              "createState": "Criar estado",
              "removeAllStates": "Remover todos os estados",
              "removeState": "Remover",
              "renameState": "Renomear",
              "savedStates": "Estados salvos",
              "stateRestore": "Estado %d",
              "updateState": "Atualizar"
          },
          "autoFill": {
              "cancel": "Cancelar",
              "fill": "Preencher todas as células com",
              "fillHorizontal": "Preencher células horizontalmente",
              "fillVertical": "Preencher células verticalmente"
          },
          "lengthMenu": "Exibir _MENU_ resultados por página",
          "searchBuilder": {
              "add": "Adicionar Condição",
              "button": {
                  "0": "Construtor de Pesquisa",
                  "_": "Construtor de Pesquisa (%d)"
              },
              "clearAll": "Limpar Tudo",
              "condition": "Condição",
              "conditions": {
                  "date": {
                      "after": "Depois",
                      "before": "Antes",
                      "between": "Entre",
                      "empty": "Vazio",
                      "equals": "Igual",
                      "not": "Não",
                      "notBetween": "Não Entre",
                      "notEmpty": "Não Vazio"
                  },
                  "number": {
                      "between": "Entre",
                      "empty": "Vazio",
                      "equals": "Igual",
                      "gt": "Maior Que",
                      "gte": "Maior ou Igual a",
                      "lt": "Menor Que",
                      "lte": "Menor ou Igual a",
                      "not": "Não",
                      "notBetween": "Não Entre",
                      "notEmpty": "Não Vazio"
                  },
                  "string": {
                      "contains": "Contém",
                      "empty": "Vazio",
                      "endsWith": "Termina Com",
                      "equals": "Igual",
                      "not": "Não",
                      "notEmpty": "Não Vazio",
                      "startsWith": "Começa Com",
                      "notContains": "Não contém",
                      "notStarts": "Não começa com",
                      "notEnds": "Não termina com"
                  },
                  "array": {
                      "contains": "Contém",
                      "empty": "Vazio",
                      "equals": "Igual à",
                      "not": "Não",
                      "notEmpty": "Não vazio",
                      "without": "Não possui"
                  }
              },
              "data": "Data",
              "deleteTitle": "Excluir regra de filtragem",
              "logicAnd": "E",
              "logicOr": "Ou",
              "title": {
                  "0": "Construtor de Pesquisa",
                  "_": "Construtor de Pesquisa (%d)"
              },
              "value": "Valor",
              "leftTitle": "Critérios Externos",
              "rightTitle": "Critérios Internos"
          },
          "searchPanes": {
              "clearMessage": "Limpar Tudo",
              "collapse": {
                  "0": "Painéis de Busca",
                  "_": "Painéis de Busca (%d)"
              },
              "count": "{total}",
              "countFiltered": "{shown} ({total})",
              "emptyPanes": "Nenhum Painel de Busca",
              "loadMessage": "Carregando Painéis de Busca...",
              "title": "Filtros Ativos",
              "showMessage": "Mostrar todos",
              "collapseMessage": "Fechar todos"
          },
          "thousands": ".",
          "datetime": {
              "previous": "Anterior",
              "next": "Próximo",
              "hours": "Hora",
              "minutes": "Minuto",
              "seconds": "Segundo",
              "amPm": [
                  "am",
                  "pm"
              ],
              "unknown": "-",
              "months": {
                  "0": "Janeiro",
                  "1": "Fevereiro",
                  "10": "Novembro",
                  "11": "Dezembro",
                  "2": "Março",
                  "3": "Abril",
                  "4": "Maio",
                  "5": "Junho",
                  "6": "Julho",
                  "7": "Agosto",
                  "8": "Setembro",
                  "9": "Outubro"
              },
              "weekdays": [
                  "Domingo",
                  "Segunda-feira",
                  "Terça-feira",
                  "Quarta-feira",
                  "Quinte-feira",
                  "Sexta-feira",
                  "Sábado"
              ]
          },
          "editor": {
              "close": "Fechar",
              "create": {
                  "button": "Novo",
                  "submit": "Criar",
                  "title": "Criar novo registro"
              },
              "edit": {
                  "button": "Editar",
                  "submit": "Atualizar",
                  "title": "Editar registro"
              },
              "error": {
                  "system": "Ocorreu um erro no sistema (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Mais informações<\/a>)."
              },
              "multi": {
                  "noMulti": "Essa entrada pode ser editada individualmente, mas não como parte do grupo",
                  "restore": "Desfazer alterações",
                  "title": "Multiplos valores",
                  "info": "Os itens selecionados contêm valores diferentes para esta entrada. Para editar e definir todos os itens para esta entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão seus valores individuais."
              },
              "remove": {
                  "button": "Remover",
                  "confirm": {
                      "_": "Tem certeza que quer deletar %d linhas?",
                      "1": "Tem certeza que quer deletar 1 linha?"
                  },
                  "submit": "Remover",
                  "title": "Remover registro"
              }
          },
          "decimal": ",",
          "stateRestore": {
              "creationModal": {
                  "button": "Criar",
                  "columns": {
                      "search": "Busca de colunas",
                      "visible": "Visibilidade da coluna"
                  },
                  "name": "Nome:",
                  "order": "Ordernar",
                  "paging": "Paginação",
                  "scroller": "Posição da barra de rolagem",
                  "search": "Busca",
                  "searchBuilder": "Mecanismo de busca",
                  "select": "Selecionar",
                  "title": "Criar novo estado",
                  "toggleLabel": "Inclui:"
              },
              "duplicateError": "Já existe um estado com esse nome",
              "emptyError": "Não pode ser vazio",
              "emptyStates": "Nenhum estado salvo",
              "removeConfirm": "Confirma remover %s?",
              "removeError": "Falha ao remover estado",
              "removeJoiner": "e",
              "removeSubmit": "Remover",
              "removeTitle": "Remover estado",
              "renameButton": "Renomear",
              "renameLabel": "Novo nome para %s:",
              "renameTitle": "Renomear estado"
          }
      },
  });


  if(window.innerWidth > 1199){
    $("#btnmenubody").addClass('toggle-sidebar');
  }
    
});
