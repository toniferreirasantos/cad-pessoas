
/*--------------------------------
	FORMULÁRIO DE CADASTRO
---------------------------------- */
$("#form_cadastro").validate({
  rules:{
    nome_pessoa: {required:true, minlength: 5},
    cpf_pessoa:  {required:true, minlength: 14},
    // nasc_pessoa: {required:true},
    peso_pessoa:  {required:false, min: 1},
    // uf_pessoa:   {required:true}
  },
  messages: {
    nome_pessoa: {required: 'Informe o nome!', minlength: "Nome muito curto!"},
    cpf_pessoa:  {required: 'Informe o CPF / CNPJ!', minlength: "CPF/CNPJ inválido!"},
    // nasc_pessoa: {required: 'Informe a data de nascimento!'},
    peso_pessoa: {required: '', min: "Valor inválido"},
    // uf_pessoa:   {required: 'Selecione a unidade federativa!'}
  },
  submitHandler: function(e) {

    $.ajax({
      url: "./crud/post/",
      type: "POST",
      data: $('#form_cadastro').serialize(),
      success: function (response){ 
        
        console.log(response);
        mensagens_resposta(response);

        var jSON_Object = $.parseJSON(response);
        if (jSON_Object['result'] == 'success') {
          $('#modal_cadastro').modal('hide'); // FECHA O MODAL
          $('#form_cadastro')[0].reset();     // LIMPA O FORM
          get_pessoas();                      // 'REPOPULA' A TABLE
        }

      },
      error:function () {
        mensagens_erro('<b>ERRO AO SALVAR OS DADOS!</b><br>Atualize a página e tente novamente.');
      }
    });
  },
  errorPlacement : function(error, element) {
    error.insertAfter(element.parent());
  }
});






/*----------------------------------
	OBTEM A TABLE DE PESSOAS VIA AJAX
------------------------------------ */
function get_pessoas() {
  
  $.ajax({
    url: "./crud/get/",
    type: "POST",
    dataType: 'html', 
    cache: false,
    success: function(response) {
      $('#div_table_pessoas').html(response);
    },
    error:function () {
      console.log('Erro GET');
    }
  });


} // get_pessoas()




// POPULA A TABLE APOS RENDERIZAR O DOCUMENT
$(document).ready(() => {
  get_pessoas();
});








/*----------------------------------
	MASCARA PARA CPF/CNPJ
------------------------------------ */
function mascaraMutuario(o,f){
  v_obj=o;
  v_fun=f;
  setTimeout('execmascara()',1);
}
function execmascara(){
  v_obj.value=v_fun(v_obj.value);
}
function cpfCnpj(v){

  //Remove tudo o que nÃƒÂ£o ÃƒÂ© dÃƒÂ­gito
  v=v.replace(/\D/g,"");

  if (v.length < 14) { //CPF

    //Coloca um ponto entre o terceiro e o quarto dÃƒÂ­gitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2");

    //Coloca um ponto entre o terceiro e o quarto dÃƒÂ­gitos
    //de novo (para o segundo bloco de nÃƒÂºmeros)
    v=v.replace(/(\d{3})(\d)/,"$1.$2");

    //Coloca um hÃƒÂ­fen entre o terceiro e o quarto dÃƒÂ­gitos
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");

  } else { //CNPJ

    //Coloca ponto entre o segundo e o terceiro dÃƒÂ­gitos
    v=v.replace(/^(\d{2})(\d)/,"$1.$2");

    //Coloca ponto entre o quinto e o sexto dÃƒÂ­gitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3");

    //Coloca uma barra entre o oitavo e o nono dÃƒÂ­gitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2");

    //Coloca um hÃƒÂ­fen depois do bloco de quatro dÃƒÂ­gitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2");

  }

  return v;
}






















/*-------------------------------------------
	FUNÇÕES COMPLEMENTARES DO IZITOAST PLUGIN
--------------------------------------------- */
function mensagem_sucesso(msg, posicao = 'topRight') {  
  iziToast.success({
    title: '',
    message: msg,
    position: posicao,
    maxWidth: 400
    
  });
}
    

// MENSAGENS ESPECIFICA DE SUCESSO (VERMELHA)
function mensagem_erro(msg, posicao = 'topRight') {  
  iziToast.error({
    title: '',
    message: msg,
    position: posicao,
    maxWidth: 400
  });
}   


// MENSAGENS ESPECIFICA DE INFORMAÃ‡ÃƒO (AZUL)
function mensagem_info(msg, posicao = 'topRight') {  
  iziToast.info({
    title: '',
    message: msg,
    position: posicao,
    maxWidth: 400
  });
}


// MENSAGENS ESPECIFICA DE ATENÃ‡ÃƒO (AMARELA)
function mensagem_atencao(msg, posicao = 'topRight') {  
  iziToast.warning({
    title: '',
    message: msg,
    position: posicao,
    maxWidth: 400
  });
}



// MENSAGENS GERAIS DE SUCESSO
function mensagens_resposta(data, position = 'topRight') {

  // Trata o Retorno recebido em JSON
  var jSON_Object = $.parseJSON(data);

  if (jSON_Object['result'] === 'success') {
    mensagem_sucesso(jSON_Object['message'], position);
  }
  else if (jSON_Object['result'] === 'error') {
    mensagem_erro(jSON_Object['message'], position);
  }
  else if (jSON_Object['result'] === 'info') {
    mensagem_info(jSON_Object['message'], position);
  }
  else {
    mensagem_atencao(jSON_Object['message'], position);
  }

} // mensagens_resposta()










/*-----------------------------------------------
	---- FUNCTION ALERT CONFIRM DELETE FOTP  ---- 
------------------------------------------------- */
function confirma_delete_pessoa(nome_pessoa, id_pessoa) {
  
  if ( !nome_pessoa.trim() || !id_pessoa.trim()) {
    mensagem_atencao('Erro na obtenção dos dados desta pessoa!');
    return;
  }

  iziToast.show({
    id: 'haduken',
    theme: 'dark',
    icon: 'icon-contacts',
    title: 'DELETAR PESSOA!',
    message: 'Deseja realmente <strong>DELETAR</strong> o registro de ' +nome_pessoa+ '?',
    position: 'center',
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    iconColor: 'rgb(50, 118, 177)',
    progressBarColor: 'rgb(50, 118, 177)',
    imageWidth: 70,
    layout: 2,
    maxWidth: 420,
    onClosed: function(instance, toast, closedBy){
      // ...
    },
    buttons: [

      // BOTÃO CONFIRMAR
      ['<button class="btn-notificacao-sim"><b>CONFIRMAR</b></button>', function (instance, toast) {
        deleta_pessoa(id_pessoa);
        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button'); // Fecha o Alert
      }, true],

      // BOTÃO CANCELAR
      ['<button class="btn-notificacao-nao"><b>CANCELAR</b></button>', function (instance, toast) {
        // Fecha o Alert
        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
      }, false]

    ]
  });

}




/* --------------------------------------------
  O REGISTRO DA PESSOA
----------------------------------------------- */
function deleta_pessoa(id_pessoa) {

  $.ajax({
    url: "./crud/del/",
    type: "POST",
    data:'id_pessoa='+id_pessoa,
    success: function(response){ 
      console.log(response);
      mensagens_resposta(response);

      var jSON_Object = $.parseJSON(response);
      if (jSON_Object['result'] == 'success') {
       
        // 'REPOPULA' A TABLE
        get_pessoas(); 
      }

    },
    error:function () {
      mensagens_erro('<b>ERRO!</b><br>Atualize a página e tente novamente.');
    }
  });
 
 
}