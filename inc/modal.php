<div class="modal fade" id="modal_cadastro">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- HEADER MODAL -->
      <div class="modal-header bg-primary text-white">
        <button type="button" class="close nmr" data-dismiss="modal">
          &times;
        </button>
        <h4 class="modal-title"><i class="fa fa-user mr-lg"></i>Cadastro de usuário</h4>
      </div>

      <!-- BODY MODAL -->
      <div class="modal-body">

        <!-- FORMULÁRIO DE CADASTRO DE PESSOAS -->
        <form id="form_cadastro">
          <div class="form-group nmb">
            <div class="row">

              <div class="col-sm-12 mb-lg">
                <label class="nmb">Nome completo: *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg"></i></span>
                  <input name="nome_pessoa" class="form-control input-lg" placeholder="Nome completo" type="text">
                </div>
              </div>

            </div>
            <div class="row">

              <div class="col-sm-6 col-xs-12 mb-lg">
                <label class="nmb">CPF: *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-address-card fa-lg"></i></span>
                  <input name="cpf_pessoa" class="form-control input-lg" placeholder="CPF / CNPJ" type="text" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18">
                </div>
              </div>

              <div class="col-sm-6 col-xs-12 mb-lg">
                <label class="nmb">Data de nascimento: *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span>
                  <input name="nasc_pessoa" class="form-control input-lg" placeholder="Data de Nascimento" type="date">
                </div>
              </div>

            </div>
            <div class="row">

              <div class="col-sm-6 col-xs-12 mb-lg">
                <label class="nmb">Peso: *</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-balance-scale fa-lg"></i></span>
                  <input name="peso_pessoa" class="form-control input-lg" placeholder="Peso (Kg)" type="number" step="0.01">
                </div>
              </div>

              <div class="col-sm-6 col-xs-12 mb-lg">
                <div class="form-group">
                  <label class="nmb">UF: *</label>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-flag fa-lg"></i></span>

                    <select name="uf_pessoa" class="form-control input-lg">                
                      <?php get_estados(); ?>
                    </select>

                  </div>
                </div>
              </div>


              <div class="col-sm-12">
                <button type="submit" class="btn btn-lg btn-block btn-primary">CADASTRAR</button>
              </div>

            </div>
          </div>
        </form>




      </div>

    </div>
  </div>
</div>