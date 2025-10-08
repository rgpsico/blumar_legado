// SCRIPT PARA ATENDER A LOGICA DE DIAS TRAVADOS NO CALENDARIO

$().ready(function(){
 
	//var data = new Date();
	//var dia = data.getDay();
	//var data_min;
	//if(dia == 6) {
		//data_min = 3;
	//} else {
		//data_min = 0;
	//}
    //$.datepicker.setDefaults($.datepicker.regional['pt-BR']);  $("#datafield").val()
	$(".calendario").datepicker();
 
 
	
	$("#date").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
 
	$("#data_news").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	 
	$("#data_news2").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	
	
	$("#data_birth").datepicker({
		 yearRange: "-70:+10", 
		showAnim: 'fadeIn',
		duration: 'fast',
	    changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true 
	});
	
	
	
	
	
	$("#data_ctps").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	$("#data_cnh").datepicker({
		yearRange: "-10:+15", 
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	$("#data_1cnh").datepicker({
		yearRange: "-10:+15", 
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	
	$("#data_chegada").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	$("#data_id").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	

	$("#data_exp_id").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});

	$("#cnh_data_exp").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});



	$("#rne_data").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});


	$("#data_nasc_dep").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});




	$("#data_contratacao").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
		
 
	
	$("#dt_vencimento_contrato").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	
	$("#dt_exam_admiss").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	$("#dt_exp_45").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	
	$("#dt_exp_90").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
	$("#dt_ppra").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
	
   $("#dt_ent_demiss").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
   
   $("#dt_exam_demiss").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
   
   
   $("#dt_ini").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
	
   
   $("#dt_saida").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
   
     
   $("#dt_htl_tobe_open").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});
     
    $("#dt_exclusao_saude").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});   
   
    
    $("#dt_adesao_saude_dependente").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});    
   
    $("#dt_exclusao_saude_dependente").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});    
     
    
    $("#dt_adesao_dental").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});  
   
    $("#dt_exclusao_dental").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});  
     
 
    $("#dt_adesao_dental_dependente").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
    
    
    $("#dt_exclusao_dental_dependente").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});    
    
    
    $("#dt_adesao_tkt_refeicao").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});    
    
    
    $("#dt_exclusao_tkt_refeicao").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	});    
    
    
    $("#dt_adesao_tkt_alimentacao").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
    
    $("#dt_exclusao_tkt_alimentacao").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
    
    
    $("#data_inicio_curso").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
    
    
    
    
    $("#data_termino_curso").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
    
    
    $("#data_inicio_emprestimo").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
    
    
    
    $("#data_termino_emprestimo").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
    
    
    
    $("#validade_seguro").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
    
    
    $("#vistoria").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
     
    $("#log_in").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		defaultDate: $("#datafield").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
     

    
    
    $("#log_out").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		//defaultDate:  $("#dataout").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
     
    $("#date_out").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		//defaultDate:  $("#dataout").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
     
    $("#date_in").datepicker({
		showAnim: 'fadeIn',
		duration: 'fast',
		//defaultDate:  $("#dataout").val(),
		changeMonth: true,
		changeYear:true,
	        showOn: 'button',
		buttonImage: 'http://www.blumar.com.br/images/site/calendar.gif',
		buttonImageOnly: true
	}); 
     
});
