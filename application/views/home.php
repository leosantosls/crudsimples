<main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-hover table-nowrap dt-responsive" style="overflow: auto;">
                            <thead>
                                <tr>
                                    <th class='not-export-col' scope="col">Ações</th>
                                    <th class="Search" scope="col">Cod</th>
                                    <th class="Search" scope="col">Nome</th>
                                    <th class="Search" scope="col">CPF</th>
                                    <th class="Search" scope="col">Telefone</th>
                                    <th class="Search" scope="col">Cidade</th>
                                    <th scope="col">Ativo</th>
                                    <th class="Search" scope="col">Data Cadastro</th>
                                    <th class="Search" scope="col">Data Alteração</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($list as $item){ ?>
                                    <tr>
                                        <td class='not-export-col'>
                                            <div class="dropdown">
                                                
                                                    <button class="btn btn-sm btn-icon" type="button" id="dropdownMenuButton<?=$item->cod_user_usr?>" data-bs-boundary="window" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bx bx-dots-horizontal-rounded" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Ações"></i>
                                                    </button>
                                                    <div class="dropdown-menu" data-bs-boundary="window" aria-labelledby="dropdownMenuButton<?=$item->cod_user_usr?>">
                                                        <?php if($item->ativo != 'DESATIVADO'){?>
                                                            <a class="dropdown-item" href="#" onclick="editarUsuario(<?=$item->cod_user_usr?>)"><i class="bx bxs-pencil mr-2"></i> Editar Registro</a>
                                                            <a class="dropdown-item text-danger" onclick="return confirm('Deseja Desativar esse Usuário?');" href="<?=base_url()?>home/removeuser/<?=$item->cod_user_usr?>"><i class="bx bxs-trash mr-2"></i> Desativar</a>
                                                        <?php }else{ ?>
                                                            <a class="dropdown-item text-danger" href="#"> Sem Ações</a>
                                                        <?php } ?>
                                                    </div>
                                            </div>
                                        </td>
                                        <td><?=$item->cod_user_usr?></td>
                                        <td><?=$item->des_nome_usr?></td>
                                        <td><?=$item->num_doc_usr?></td>
                                        <td><?=$item->num_tel_usr?></td>
                                        <td><span class="badge <?=($item->ativo == 'ATIVO')?'bg-success':'bg-danger'?>"><?=$item->ativo?></span></td>
                                        <td><?=$item->des_cidade_usr?> - <?=$item->des_estado_usr?></td>
                                        <td><?=$item->data_ins?> <?=hint('Dados do Cadastro <br> Usuário:'.$item->usuario_insert.' <br> Data:'.$item->data_ins.'')?> </td>
                                        <td><?=$item->data_update?> <?=($item->data_update != '')?hint('Dados da Ultima Alteração <br> Usuário:'.$item->usuario_update.' <br> Data:'.$item->data_update.''):''?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</main>

<div class="modal fade" id="modalCadastro" tabindex="-1" data-bs-backdrop='static'>
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Novo Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="#" method="post" id="formulario">
            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="des_nome_usr">Nome<span class="kv-reqd">*</span></label>
                      <input type="text" class="form-control" name="des_nome_usr" id="des_nome_usr" autocomplete="off" value="" required>
                      <input type="hidden" name="cod_user_usr" id="cod_user_usr" value="0">
                  </div>
              </div>

              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="num_doc_usr">CPF</label>
                      <input type="text" class="form-control" name="num_doc_usr" id="num_doc_usr" autocomplete="off" value="">
                  </div>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="dta_nascimento_usr">Data de Nascimento</label>
                      <input type="text" class="form-control" name="dta_nascimento_usr" id="dta_nascimento_usr" autocomplete="off" value="">
                  </div>
              </div>

              <div class="col-sm-6">
                  <div class="form-group">
                      <label for="num_doc_usr">Telefone / Celular</label>
                      <input type="text" class="form-control" name="num_tel_usr" id="num_tel_usr" autocomplete="off" value="">
                  </div>
              </div>
            </div>
            <br>

            <div class="row">
              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="des_endereco_usr">Endereço</label>
                      <input type="text" class="form-control" name="des_endereco_usr" id="des_endereco_usr" autocomplete="off" value="">
                  </div>
              </div>

              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="des_estado_usr">Estado<span class="kv-reqd">*</span></label>
                      <select name="des_estado_usr" id="des_estado_usr" class="form-control" data-live-search="true" autocomplete="off" required>
                          <option value=""> Selecione o Estado do Usuario </option>
                      </select>
                  </div>
              </div>

              <div class="col-sm-4">
                  <div class="form-group">
                      <label for="des_cidade_usr">Cidade<span class="kv-reqd">*</span></label>
                      <select name="des_cidade_usr" id="des_cidade_usr" class="form-control" data-live-search="true" autocomplete="off" required>
                        <option value=""> Selecione um Estado Antes </option>
                      </select>
                  </div>
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" onclick="validar()" id="btn_salvar">Salvar</button>
        </div>
      </div>
    </div>
  </div>