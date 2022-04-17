<main id="main" class="main">
    <?=$controller->testa_acesso('U01', 1, 1); ?>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <form class="row g-3 needs-validation"  autocomplete="off" action="<?=base_url()?>usuario/profileViewsSave" id="form" method="POST">
                         <label for="marcarTodos"> <input type="checkbox" name="marcarTodos" id="marcarTodos" onclick="marcardesmarcar()"> Marcar Todos </label> 
                         <input type="hidden" name="usuario_id_usr" id="usuario_id_usr" value="<?=$usuario_id_usr?>">

                         <div class="form-group row">
                            <hr>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>

                        <table class="table" width="50%">
                            <thead>
                                <tr>
                                    <th>Menu Principal</th>
                                    <th>SubMenu</th>
                                </tr>
                            </thead>
                            <?php 
                                foreach($form as $item){
                                    if($item->unico_mdl == 1 || $item->url_mdl == "#"){
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="checkbox" name="menu[]" id="menu_<?=$item->modulo_id_mdl?>" value="<?=$item->modulo_id_mdl?>" <?=($item->id_rel_rmu > 0)?'checked':''?>> <label for="menu_<?=$item->modulo_id_mdl?>"> <?=$item->descricao_mdl?> </label> 
                                </td>
                                <td></td>
                            </tr>
                                <?php 
                                    foreach($form as $subitem){
                                        if($subitem->cod_grupo_mdl == $item->cod_acesso_mdl){
                                ?>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="checkbox" class="checkbox" name="menu[]" id="menu_<?=$subitem->modulo_id_mdl?>" value="<?=$subitem->modulo_id_mdl?>" <?=($subitem->id_rel_rmu > 0)?'checked':''?>> <label for="menu_<?=$subitem->modulo_id_mdl?>"> <?=$subitem->descricao_mdl?> </label> 
                                    </td>
                                </tr>
                                        
                                <?
                                        }
                                    }
                                }
                            }
                            ?>
                        </table>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</main>