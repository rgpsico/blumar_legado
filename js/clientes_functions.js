$(document).ready(function() {
	
	inicializaPainelOperadoresDoCliente();
});



function habilita_ckb_ro() {
			if(document.getElementById('ativar_usuario_no_salesystem').checked == true) {
				document.getElementById('desativar_reservas_online').disabled = false;
				document.getElementById('consome_allotment').disabled = false;
			} else {
				document.getElementById('desativar_reservas_online').disabled = true;
				document.getElementById('desativar_reservas_online').checked = false;
				document.getElementById('consome_allotment').disabled = true;
				document.getElementById('consome_allotment').checked = false;
			}
		 
		}

		function inicializaPainelOperadoresDoCliente() {
			qtd_sub_paineis = 0;
			adiciona_sub_painel();
			// alert('Entrei na Inicializacao');
		}

		function adiciona_sub_painel() {
		 
				if(qtd_sub_paineis >= 15)
					return;
	 
			qtd_sub_paineis = qtd_sub_paineis + 1;
			document.getElementById("painel_operadores_blumar_cliente_"+qtd_sub_paineis).style.display = '';
		}

		function remove_sub_painel() {
			if(qtd_sub_paineis == 1)
				return;
			document.getElementById("painel_operadores_blumar_cliente_"+qtd_sub_paineis).style.display = 'none';
			document.getElementById("cliente_func_operador_blumar_"+qtd_sub_paineis).value = "";
			document.getElementById("cliente_email_operador_blumar_"+qtd_sub_paineis).value = "";
			qtd_sub_paineis = qtd_sub_paineis - 1;
		}

		function toggle() {
			var div1 = document.getElementById('div1')
			if(div1.style.display == 'none') {
				div1.style.display = 'block';
			} else {
				div1.style.display = 'none';
			}
		}


		function show_hide(currentObj) {
			for(var i = 1; i <= 3; i++) { // Número máximo de opções que o primeiro nível de select pode ter
				if(eval("document.getElementById('"+currentObj.id+"_"+i+"')")) // Verifica se o objeto existe
					eval("document.getElementById('"+currentObj.id+"_"+i+"').style.display = 'none'"); // Esconde o objeto caso ele exista
				for(var j = 1; j <= 3; j++) { // Número máximo de opções que o segundo nível de select pode ter
					if(eval("document.getElementById('"+currentObj.id+"_"+i+"_"+j+"')"))
						eval("document.getElementById('"+currentObj.id+"_"+i+"_"+j+"').style.display = 'none'");
				}
			}
			try {
				parseInt(currentObj.value);
				if(parseInt(currentObj.value) % parseInt(currentObj.value) == 0) {
					eval("document.getElementById('"+currentObj.id+"_"+currentObj.value+"').style.display = 'block'");
				}
			} catch (e) {
				void(0);
			}
		}


		