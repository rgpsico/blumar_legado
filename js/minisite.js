
function acao_minisite () { 

				$.ajax({
				dataType: "html",  
				url: "minisite/miolo_minisite.php",  
				error: function() {
					alert("Erro ao mostrar o menu do Minisite de Produtos!");
				},
				 success: function(resposta) {
					$("#container_miolo").html(resposta);
				 } 
			 });
 }



//script para os miolos

function admin_hotels () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/miolo_hotels.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function admin_tours () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/miolo_tours.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function admin_programs () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/miolo_programs.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function admin_bars () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/miolo_bars.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Bars & Restaurants!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function admin_fornec () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/miolo_fornec.php",  
	 error: function() {
		alert("Erro ao mostrar o menu de Novos Fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }



function admin_inspecs () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/miolo_inspecs.php",  
	 error: function() {
		alert("Erro ao mostrar o menu de Inspections!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }



function admin_clients () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/miolo_clients.php",  
	 error: function() {
		alert("Erro ao mostrar o menu de Clientes em Potencial!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }












//script para novo formulario de inserção

function novo_htl_tobe_open () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_hotels_tobe_open.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }



function novo_new_tours () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_new_tours.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }




function novo_programs () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_new_programs.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }




function novo_bars () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_new_bars.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function novo_fornec () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_new_fornec.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function novo_inspecs () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_new_inspecs.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }




function novo_clients () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_new_clients.php",  
	 error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }







//scripts para inserir novo conteudo
function insert_htl_tobe_open () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/insert_htl_tobe_open.php",  
	type: 'POST',
	data: {
		 nome: $("#nome").val(),
		dt_htl_tobe_open: $("#dt_htl_tobe_open").val(),
		location: $("#location").val(),
		description: $("#description").val(),
		description_ing: $("#description_ing").val(),
		obs: $("#obs").val(),
		obs_ing: $("#obs_ing").val(),
		path: $("#path").val(),
		foto: $("#foto").val(),
		keywords: $("#keywords").val()
	 },
	error: function() {
		alert("Erro ao inserir Hotels to be open!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }





function insert_new_tours () { 

	if ($("#grp").is(":checked")) {  
		 var grp = "true"; 
	} else {
		 var grp = "false";
	}
	
	if ($("#fit").is(":checked")) {  
		 var fit = "true"; 
	} else {
		 var fit = "false";
	}	
	
	
	
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_new_tours.php",  
	type: 'POST',
	data: {
		nome: $("#nome").val(),
		location: $("#location").val(),
		description: $("#description").val(),
		description_ing: $("#description_ing").val(),
		obs: $("#obs").val(),
		obs_ing: $("#obs_ing").val(),
		path: $("#path").val(),
		foto: $("#foto").val(),
		keywords: $("#keywords").val(),
		grp: grp,
		fit: fit,
		classification: $("#classification").val(),
		fornec: $("#fornec").val()
 	
	 },
	error: function() {
		alert("Erro ao inserir Hotels to be open!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }






function insert_programs () { 

	if ($("#grp").is(":checked")) {  
		 var grp = "true"; 
	} else {
		 var grp = "false";
	}
	
	if ($("#fit").is(":checked")) {  
		 var fit = "true"; 
	} else {
		 var fit = "false";
	}	
	
	
	
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_programs.php",  
	type: 'POST',
	data: {
		nome: $("#nome").val(),
		location: $("#location").val(),
		description: $("#description").val(),
		description_ing: $("#description_ing").val(),
		obs: $("#obs").val(),
		obs_ing: $("#obs_ing").val(),
		path: $("#path").val(),
		foto: $("#foto").val(),
		keywords: $("#keywords").val(),
		grp: grp,
		fit: fit,
		rota: $("#rota").val(),
		duracao: $("#duracao").val()
 	
	 },
	error: function() {
		alert("Erro ao inserir Hotels to be open!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }






function insert_bars () { 

	if ($("#music").is(":checked")) {  
		 var music = "true"; 
	} else {
		 var music = "false";
	}
	
	if ($("#selo_boteco").is(":checked")) {  
		 var selo_boteco = "true"; 
	} else {
		 var selo_boteco = "false";
	}	
	
	
	if ($("#selo_budget").is(":checked")) {  
		 var selo_budget = "true"; 
	} else {
		 var selo_budget = "false";
	}	
	
	if ($("#selo_highend").is(":checked")) {  
		 var selo_highend = "true"; 
	} else {
		 var selo_highend = "false";
	}	
	
	if ($("#selo_romantic").is(":checked")) {  
		 var selo_romantic = "true"; 
	} else {
		 var selo_romantic = "false";
	}				
	
	if ($("#view").is(":checked")) {  
		 var view = "true"; 
	} else {
		 var view = "false";
	}	
	
	if ($("#selo_selfservice").is(":checked")) {  
		 var selo_selfservice = "true"; 
	} else {
		 var selo_selfservice = "false";
	}		
	
	if ($("#selo_trendy").is(":checked")) {  
		 var selo_trendy = "true"; 
	} else {
		 var selo_trendy = "false";
	}	
	
	
	if ($("#selo_veggie").is(":checked")) {  
		 var selo_veggie = "true"; 
	} else {
		 var selo_veggie = "false";
	}	
	
 
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_bars.php",  
	type: 'POST',
	data: {
		nome: $("#nome").val(),
		dt_htl_tobe_open: $("#dt_htl_tobe_open").val(),
		location: $("#location").val(),
		foto: $("#foto").val(),
		obs: $("#obs").val(),
		obs_ing: $("#obs_ing").val(),
		path: $("#path").val(),
		keywords: $("#keywords").val(),
		faixa: $("#faixa").val(),
		especialidade: $("#especialidade").val(),
		address: $("#address").val(),
		tel: $("#tel").val(),
		contact: $("#contact").val(),
		music: music,
		selo_boteco: selo_boteco,
		selo_budget: selo_budget,
		selo_highend: selo_highend,
		selo_romantic: selo_romantic,
		view: view,
		selo_selfservice: selo_selfservice,
		selo_trendy: selo_trendy,
		selo_veggie: selo_veggie
		
	 },
	error: function() {
		alert("Erro ao inserir bars & Restaurants!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }

 



function insert_fornec () { 
 
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_fornec.php",  
	type: 'POST',
	data: {
		nome: $("#nome").val(),
        location: $("#location").val(),
		foto: $("#foto").val(),
		obs: $("#obs").val(),
		tpsrv: $("#tpsrv").val(),
		path: $("#path").val(),
		keywords: $("#keywords").val(),
        address: $("#address").val(),
		tel: $("#tel").val(),
		contact: $("#contact").val() 
		
	 },
	error: function() {
		alert("Erro ao inserir Novos Fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }

 

function insert_inspecs () { 
 
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_inspecs.php",  
	type: 'POST',
	data: {
		nome: $("#nome").val(),
		dt_htl_tobe_open: $("#dt_htl_tobe_open").val(),
        location: $("#location").val(),
		foto: $("#foto").val(),
		obs: $("#obs").val(),
		path_fotos: $("#path_fotos").val(),
		path: $("#path").val(),
		keywords: $("#keywords").val(),
        contact: $("#contact").val() 
		
	 },
	error: function() {
		alert("Erro ao inserir uma nova Inspeção!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }



function insert_clients () { 
 
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_clients.php",  
	type: 'POST',
	data: {
		nome: $("#nome").val(),
		dt_htl_tobe_open: $("#dt_htl_tobe_open").val(),
        location: $("#location").val(),
		foto: $("#foto").val(),
		obs: $("#obs").val(),
		nome_indicou: $("#nome_indicou").val(),
		ano_indicou: $("#ano_indicou").val(),
		nome_feira: $("#nome_feira").val(),
		ano_feira: $("#ano_feira").val(),
		keywords: $("#keywords").val(),
        contact: $("#contact").val(), 
        email: $("#email").val(),
        origem: $("#origem").val(),
        tp_contact: $("#tp_contact").val(),
        mkphtl: $("#mkphtl").val(),
        mkpsvc: $("#mkpsvc").val()
        
	 },
	error: function() {
		alert("Erro ao inserir uma novo Cliente em potencial!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }















//scripts para buscar conteudo para alteração
function update_hotels_tobe_open () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_update_htl_tobe_open.php",  
	type: 'POST',
	data: {
		 pk_produtos: $("#pk_produtos").val() 
	 },
	error: function() {
		alert("Erro ao inserir Hotels to be open!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }



function update_new_tours () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_update_new_tours.php",  
	type: 'POST',
	data: {
		 pk_produtos: $("#pk_produtos").val() 
	 },
	error: function() {
		alert("Erro ao inserir Hotels to be open!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function update_programs () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_update_programs.php",  
	type: 'POST',
	data: {
		 pk_produtos: $("#pk_produtos").val() 
	 },
	error: function() {
		alert("Erro ao inserir Hotels to be open!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function update_bars () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_update_bars.php",  
	type: 'POST',
	data: {
		 pk_produtos: $("#pk_produtos").val() 
	 },
	error: function() {
		alert("Erro ao inserir bars & Restaurants!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }



function update_fornec () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_update_fornec.php",  
	type: 'POST',
	data: {
		 pk_produtos: $("#pk_produtos").val() 
	 },
	error: function() {
		alert("Erro ao inserir novos fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }



function update_inspecs () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_update_inspecs.php",  
	type: 'POST',
	data: {
		 pk_produtos: $("#pk_produtos").val() 
	 },
	error: function() {
		alert("Erro ao inserir novos fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }


function update_clients () { 

	$.ajax({
	dataType: "html",  
	url: "minisite/form_update_clients.php",  
	type: 'POST',
	data: {
		 pk_produtos: $("#pk_produtos").val() 
	 },
	error: function() {
		alert("Erro ao inserir novos clientes!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }








//scripts para inserir atualização de conteudo 
function insert_update_htl_tobe_open () { 

	if ($("#ativo").is(":checked")) {  
		 var ativo = "true"; 
	} else {
		 var ativo = "false";
	}
	 $.ajax({
	dataType: "html",  
	url: "minisite/insert_update_htl_tobe_open.php",  
	type: 'POST',
	data: {
		pk_produtos: $("#pk_produtos").val(),
		nome: $("#nome").val(),
		dt_htl_tobe_open: $("#dt_htl_tobe_open").val(),
		location: $("#location").val(),
		description: $("#description").val(),
		description_ing: $("#description_ing").val(),
		obs: $("#obs").val(),
		obs_ing: $("#obs_ing").val(),
		path: $("#path").val(),
		foto: $("#foto").val(),
		keywords: $("#keywords").val(),
		ativo: ativo
	 },
	error: function() {
		alert("Erro ao inserir Hotels to be open!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }




function insert_update_new_tours () { 

	if ($("#ativo").is(":checked")) {  
		 var ativo = "true"; 
	} else {
		 var ativo = "false";
	}
	
	if ($("#grp").is(":checked")) {  
		 var grp = "true"; 
	} else {
		 var grp = "false";
	}
	
	if ($("#fit").is(":checked")) {  
		 var fit = "true"; 
	} else {
		 var fit = "false";
	}
	
	
	
	 $.ajax({
	dataType: "html",  
	url: "minisite/insert_update_new_tours.php",  
	type: 'POST',
	data: {
		pk_produtos: $("#pk_produtos").val(),
		nome: $("#nome").val(),
		location: $("#location").val(),
		description: $("#description").val(),
		description_ing: $("#description_ing").val(),
		obs: $("#obs").val(),
		obs_ing: $("#obs_ing").val(),
		path: $("#path").val(),
		foto: $("#foto").val(),
		keywords: $("#keywords").val(),
		ativo: ativo,
		grp: grp,
		fit:fit,
		fornec: $("#fornec").val(),
		classification: $("#classification").val() 
		
	 },
	error: function() {
		alert("Erro ao inserir Hotels to be open!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }





function insert_update_programs () { 

	if ($("#ativo").is(":checked")) {  
		 var ativo = "true"; 
	} else {
		 var ativo = "false";
	}
	
	if ($("#grp").is(":checked")) {  
		 var grp = "true"; 
	} else {
		 var grp = "false";
	}
	
	if ($("#fit").is(":checked")) {  
		 var fit = "true"; 
	} else {
		 var fit = "false";
	}
	
	
	
	 $.ajax({
	dataType: "html",  
	url: "minisite/insert_update_programs.php",  
	type: 'POST',
	data: {
		pk_produtos: $("#pk_produtos").val(),
		nome: $("#nome").val(),
		location: $("#location").val(),
		description: $("#description").val(),
		description_ing: $("#description_ing").val(),
		obs: $("#obs").val(),
		obs_ing: $("#obs_ing").val(),
		path: $("#path").val(),
		foto: $("#foto").val(),
		keywords: $("#keywords").val(),
		ativo: ativo,
		grp: grp,
		fit:fit,
		rota: $("#rota").val(),
		duracao: $("#duracao").val() 
		
	 },
	error: function() {
		alert("Erro ao inserir Special Programs!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }





function insert_update_bars () { 

	if ($("#music").is(":checked")) {  
		 var music = "true"; 
	} else {
		 var music = "false";
	}
	
	if ($("#selo_boteco").is(":checked")) {  
		 var selo_boteco = "true"; 
	} else {
		 var selo_boteco = "false";
	}	
	
	
	if ($("#selo_budget").is(":checked")) {  
		 var selo_budget = "true"; 
	} else {
		 var selo_budget = "false";
	}	
	
	if ($("#selo_highend").is(":checked")) {  
		 var selo_highend = "true"; 
	} else {
		 var selo_highend = "false";
	}	
	
	if ($("#selo_romantic").is(":checked")) {  
		 var selo_romantic = "true"; 
	} else {
		 var selo_romantic = "false";
	}				
	
	if ($("#view").is(":checked")) {  
		 var view = "true"; 
	} else {
		 var view = "false";
	}	
	
	if ($("#selo_selfservice").is(":checked")) {  
		 var selo_selfservice = "true"; 
	} else {
		 var selo_selfservice = "false";
	}		
	
	if ($("#selo_trendy").is(":checked")) {  
		 var selo_trendy = "true"; 
	} else {
		 var selo_trendy = "false";
	}	
	
	
	if ($("#selo_veggie").is(":checked")) {  
		 var selo_veggie = "true"; 
	} else {
		 var selo_veggie = "false";
	}	
	
	if ($("#ativo").is(":checked")) {  
		 var ativo = "true"; 
	} else {
		 var ativo = "false";
	}
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_update_bars.php",  
	type: 'POST',
	data: {
		
		pk_produtos: $("#pk_produtos").val(),
		nome: $("#nome").val(),
		dt_htl_tobe_open: $("#dt_htl_tobe_open").val(),
		location: $("#location").val(),
		foto: $("#foto").val(),
		obs: $("#obs").val(),
		obs_ing: $("#obs_ing").val(),
		path: $("#path").val(),
		keywords: $("#keywords").val(),
		faixa: $("#faixa").val(),
		especialidade: $("#especialidade").val(),
		address: $("#address").val(),
		tel: $("#tel").val(),
		contact: $("#contact").val(),
		music: music,
		selo_boteco: selo_boteco,
		selo_budget: selo_budget,
		selo_highend: selo_highend,
		selo_romantic: selo_romantic,
		view: view,
		selo_selfservice: selo_selfservice,
		selo_trendy: selo_trendy,
		selo_veggie: selo_veggie,
		ativo: ativo
	 },
	error: function() {
		alert("Erro ao inserir bars & Restaurants!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }




 

function insert_update_fornec () { 

 
	
	if ($("#ativo").is(":checked")) {  
		 var ativo = "true"; 
	} else {
		 var ativo = "false";
	}
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_update_fornec.php",  
	type: 'POST',
	data: {
		
		pk_produtos: $("#pk_produtos").val(),
		nome: $("#nome").val(),
        location: $("#location").val(),
		foto: $("#foto").val(),
		obs: $("#obs").val(),
        path: $("#path").val(),
		keywords: $("#keywords").val(),
        address: $("#address").val(),
		tel: $("#tel").val(),
		contact: $("#contact").val(),
		tpsrv: $("#tpsrv").val(),
		ativo: ativo
	 },
	error: function() {
		alert("Erro ao inserir Novos fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }





function insert_update_inspecs () { 

 
	
	if ($("#ativo").is(":checked")) {  
		 var ativo = "true"; 
	} else {
		 var ativo = "false";
	}
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_update_inspecs.php",  
	type: 'POST',
	data: {
		
		pk_produtos: $("#pk_produtos").val(),
		nome: $("#nome").val(),
        location: $("#location").val(),
		foto: $("#foto").val(),
		obs: $("#obs").val(),
        path: $("#path").val(),
        path_fotos: $("#path_fotos").val(),
		keywords: $("#keywords").val(),
        contact: $("#contact").val(),
        dt_htl_tobe_open: $("#dt_htl_tobe_open").val(), 
		ativo: ativo
	 },
	error: function() {
		alert("Erro ao inserir Novos fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }




function insert_update_clients () { 

 
	
	if ($("#ativo").is(":checked")) {  
		 var ativo = "true"; 
	} else {
		 var ativo = "false";
	}
	
	$.ajax({
	dataType: "html",  
	url: "minisite/insert_update_clients.php",  
	type: 'POST',
	data: {
		
		pk_produtos: $("#pk_produtos").val(),
		nome: $("#nome").val(),
        location: $("#location").val(),
		foto: $("#foto").val(),
		obs: $("#obs").val(),
        keywords: $("#keywords").val(),
        contact: $("#contact").val(),
        dt_htl_tobe_open: $("#dt_htl_tobe_open").val(), 
		ativo: ativo,
		email: $("#email").val(),
		origem: $("#origem").val(),
		tp_contact: $("#tp_contact").val(),
		nome_feira: $("#nome_feira").val(),
		ano_feira: $("#ano_feira").val(),
		nome_indicou: $("#nome_indicou").val(),
		ano_indicou: $("#ano_indicou").val(),
		mkup_htl: $("#mkup_htl").val(),
		mkup_svc: $("#mkup_svc").val() 
	 },
	error: function() {
		alert("Erro ao atualizar clientes!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });
 }




//scripts para apagar conteudo
function delete_hotels_tobe_open () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/lista_delete_hotels_tobe_open.php",  
	error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });

}

 

$(document).ready(function() { 
	   
	$("body").delegate("a.delhtltobe", "click",  function(){   
         retrive_htltobe($(this).children(".delhtltobeValue").val());
     });    
					    function retrive_htltobe (pk_produtos) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/delete_hotels_tobe_open.php", 
										type: 'POST',
										cache: false,
										data: {
										    pk_produtos: pk_produtos
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de Hotels to be opened?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao apagar o hotel to be Opened!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	




function delete_new_tours () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/lista_delete_new_tours.php",  
	error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });

}



$(document).ready(function() { 
	   
	$("body").delegate("a.delnewtours", "click",  function(){   
         retrive_newtours($(this).children(".delnewtoursValue").val());
     });    
					    function retrive_newtours (pk_produtos) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/delete_newtours.php", 
										type: 'POST',
										cache: false,
										data: {
										    pk_produtos: pk_produtos
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de new Tours & Experiencies?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao apagar o New tours & Experiences!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	

 



function delete_programs () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/lista_delete_programs.php",  
	error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });

}



$(document).ready(function() { 
	   
	$("body").delegate("a.delprograms", "click",  function(){   
         retrive_programs($(this).children(".delprogramsValue").val());
     });    
					    function retrive_programs (pk_produtos) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/delete_programs.php", 
										type: 'POST',
										cache: false,
										data: {
										    pk_produtos: pk_produtos
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de Special Programs?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao apagar o Special Programs!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	

 



function delete_bars () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/lista_delete_bars.php",  
	error: function() {
		alert("Erro ao mostrar o menu do Minisite de Produtos!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });

}



$(document).ready(function() { 
	   
	$("body").delegate("a.delbars", "click",  function(){   
         retrive_bars($(this).children(".delbarsValue").val());
     });    
					    function retrive_bars (pk_produtos) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/delete_bars.php", 
										type: 'POST',
										cache: false,
										data: {
										    pk_produtos: pk_produtos
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de Bars & Restaurants?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao apagar o Bars & Restaurants!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	



function delete_fornec () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/lista_delete_fornec.php",  
	error: function() {
		alert("Erro ao mostrar o menu de fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });

}



$(document).ready(function() { 
	   
	$("body").delegate("a.delfornec", "click",  function(){   
         retrive_fornec($(this).children(".delfornecValue").val());
     });    
					    function retrive_fornec (pk_produtos) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/delete_fornec.php", 
										type: 'POST',
										cache: false,
										data: {
										    pk_produtos: pk_produtos
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de Fornecedores?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao apagar um Fornecedores!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	






function delete_inspecs () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/lista_delete_inspecs.php",  
	error: function() {
		alert("Erro ao mostrar o menu de fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });

}



$(document).ready(function() { 
	   
	$("body").delegate("a.delinspecs", "click",  function(){   
         retrive_inspecs($(this).children(".delinspecsValue").val());
     });    
					    function retrive_inspecs (pk_produtos) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/delete_inspecs.php", 
										type: 'POST',
										cache: false,
										data: {
										    pk_produtos: pk_produtos
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de Inspeções?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao apagar um Inspeções!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	





function delete_clients () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/lista_delete_clients.php",  
	error: function() {
		alert("Erro ao mostrar o menu de fornecedores!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });

}



$(document).ready(function() { 
	   
	$("body").delegate("a.delclients", "click",  function(){   
         retrive_clients($(this).children(".delclientsValue").val());
     });    
					    function retrive_clients (pk_produtos) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/delete_clients.php", 
										type: 'POST',
										cache: false,
										data: {
										    pk_produtos: pk_produtos
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja apagar este registro de Cliente em potencial?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao apagar um Cliente em potencial!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	































//scripts para ver conteudo

function vercoments_hotels_tobe_open () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/lista_coments_hotels_tobe_open.php",  
	type: 'POST',
	data: {
		 pk_produtos: $("#pk_comments").val() 
	 },
	error: function() {
		alert("Erro ao mostrar os comentarios de  hotels to be opened!");
	},
	 success: function(resposta) {
		$("#abt_left").html(resposta);
	 } 
 });

}



$(document).ready(function() { 
	   
	$("body").delegate("a.desaprova", "click",  function(){   
         retrive_desaprova($(this).children(".desaprovaValue").val());
     });    
					    function retrive_desaprova (pk_coment_prod) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/desaprova_coments.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_coment_prod: pk_coment_prod
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja desaprovar este comentario?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao aprovar o comentario!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	


$(document).ready(function() { 
	   
	$("body").delegate("a.aprova", "click",  function(){   
         retrive_aprova($(this).children(".aprovaValue").val());
     });    
					    function retrive_aprova (pk_aprova_coment) {
						           $.ajax({
										dataType: "html",  
										url: "minisite/aprova_coments.php", 
										type: 'POST',
										cache: false,
										data: {
											pk_coment_prod: pk_aprova_coment
										 },
										beforeSend: function() {
												 var answer = confirm ("tem certeza que deseja aprovar este comentario?")
											 if (answer) {}
											 else
												return false;
												 $("#loading").fadeIn("slow");
											  },
										 error: function() {
											alert("Ocorreu algum erro ao aprovar o comentario!");
										},
									   success: function(resposta) {
											 $("#abt_left").html(resposta);
										 },
										  complete: function() {
											$("#loading").fadeOut("slow");
										}
										 }); 
  
	 }
});
	

 

function  check_content () { 
    $.ajax({
	dataType: "html",  
	url: "minisite/check_content.php",  
	type: 'POST',
	data: {
		pk_tprod: $("#pk_tprod").val() 
	 },
	error: function() {
		alert("Erro ao mostrar conteudo!");
	},
	 success: function(resposta) {
		$("#box_check").html(resposta);
	 } 
 });

}



	

function  seleciona_tp () { 

										$.ajax({
										dataType: "html",  
										url: "minisite/pega_form.php",  
										  // FUNÇÃO ERRO
										data: {
											tp:    $("#tp_contact").val() 
										},
										
										error: function() {
											alert("Error when retrieving hotel content!");
										},
										 
										success: function(resposta) {
											$("#tpcontact").html(resposta);
											 
											 
										} 
										
										
									});

}








