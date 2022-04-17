$("#num_doc_usr").mask('999.999.999-99');
$("#dta_nascimento_usr").mask('99/99/9999', {placeholder: "__/__/____"});
$("#num_tel_usr").mask("(99) 9999-9999?9", {placeholder: "(__) _____-____"})
.focusout(function (event) {
    var target, phone, element;
    target = (event.currentTarget) ? event.currentTarget : event.srcElement;
    phone = target.value.replace(/\D/g, '');
    element = $(target);
    element.unmask();
    if(phone.length > 10) {
        element.mask("(99) 99999-9999");
    } else {
        element.mask("(99) 9999-99999");
    }
});


$(document).ready(function () {
		
    $.getJSON( $('#base_url').val()+'public/assets/estados-cidades.json', function (data) {

        var options = '<option value="">Escolha um estado</option>';	

        $.each(data, function (key, val) {
            options += '<option value="' + val.sigla + '">' + val.nome + '</option>';
        });			
        

        $("#des_estado_usr").html(options);		
        $('#des_estado_usr').selectpicker('refresh');		
        
        $("#des_estado_usr").change(function () {				
        
            var options_cidades = '';
            var str = "";					
            
            $("#des_estado_usr option:selected").each(function () {
                str += $(this).text();
            });
            
            $.each(data, function (key, val) {
                if(val.nome == str) {							
                    $.each(val.cidades, function (key_city, val_city) {
                        options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                    });							
                }
            });

            $("#des_cidade_usr").html(options_cidades); 
            $('#des_cidade_usr').selectpicker('refresh');	
        }).change();		
    });
});

function validar(){
    ok = true;
    ok = validationField('des_nome_usr', 'Nome');
    if(ok)ok = validationField('des_estado_usr', 'Estado');
    if(ok)ok = validationField('des_cidade_usr', 'Cidade');

    if(ok && $("#num_doc_usr").val() != ''){
        ok = validarCPF($("#num_doc_usr").val());
        if(!ok){
            alertPersona('error', 'O CPF informado não é valido!', 5000);
            $("#num_doc_usr").val('');
        }
    }

    if(ok){
        ok = false;
        formData = $("#formulario").serializeArray();
        cod = $("#cod_user_usr").val();

        $.ajax({
            url : $('#base_url').val()+"home/saveUser/"+cod,
            type : 'POST',
            async: false,
            data : $.param(formData),
            beforeSend : function(){
                modalAguardando('Processando Dados', loopAguardando('Aguarde, estamos processando os dados do Usuario, em breve o mesmo ficará disponivel'), true);
            },
       })
       .done(function(data){
           data = JSON.parse(data);
           type = 'error';

            if(data.cod > 0){
                ok = true;
                type = 'success';
                time = 5000;
            }else{
                time = 10000;
            }

            alertPersona(type, data.msg, time);

            setTimeout(function(){ $('#verticalycentered').modal('hide');}, 1000);

            if(data.cod > 0){
                location.reload();
            }
    
            return ok;
       })
       .fail(function(jqXHR, textStatus, msg){
            alert(msg);
       });

    }
    
    return ok;
}

function novoRegistro(){
    $('#modalCadastro').modal('show');
}


function validarCPF(cpf) {	
	cpf = cpf.replace(/[^\d]+/g,'');	
	if(cpf == '') return false;	
	// Elimina CPFs invalidos conhecidos	
	if (cpf.length != 11 || 
		cpf == "00000000000" || 
		cpf == "11111111111" || 
		cpf == "22222222222" || 
		cpf == "33333333333" || 
		cpf == "44444444444" || 
		cpf == "55555555555" || 
		cpf == "66666666666" || 
		cpf == "77777777777" || 
		cpf == "88888888888" || 
		cpf == "99999999999")
			return false;		
	// Valida 1o digito	
	add = 0;	
	for (i=0; i < 9; i ++)		
		add += parseInt(cpf.charAt(i)) * (10 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)		
			rev = 0;	
		if (rev != parseInt(cpf.charAt(9)))		
			return false;		
	// Valida 2o digito	
	add = 0;	
	for (i = 0; i < 10; i ++)		
		add += parseInt(cpf.charAt(i)) * (11 - i);	
	rev = 11 - (add % 11);	
	if (rev == 10 || rev == 11)	
		rev = 0;	
	if (rev != parseInt(cpf.charAt(10)))
		return false;		
	return true;   
}

function editarUsuario(cod){
    $.ajax({
        url : $('#base_url').val()+"home/editarUsuario/"+cod,
        type : 'POST',
        async: false,
        data : null,
        beforeSend : function(){
            modalAguardando('Processando Dados', loopAguardando('Aguarde, estamos processando os dados do Usuario, em breve o mesmo ficará disponivel'), true);
        },
   })
   .done(function(data){
       data = JSON.parse(data);

    $.each(data[0], function(key, value) {
        $("#"+key).val(value).trigger('change');
    });

    $('#des_estado_usr').selectpicker('refresh');
    $('#des_cidade_usr').selectpicker('refresh');

    $("#btn_salvar").text('Alterar');

    $('#modalCadastro').modal('show');
    

   })
   .fail(function(jqXHR, textStatus, msg){
        alert(msg);
   });
}