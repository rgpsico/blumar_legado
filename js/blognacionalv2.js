
function acao_blognacionalv2() {

    $.ajax({
        dataType: "html",
        url: "blogv2/miolo_blognacional.php",
        // FUN��O ERRO
        error: function () {
            alert("Error when inserting City content!");
        },

        success: function (resposta) {
            $("#container_miolo").html(resposta);

        }


    });

}


function novo_postv2() {

    $.ajax({
        dataType: "html",
        url: "blogv2/form_novo_post.php",
        // FUN��O ERRO
        error: function () {
            alert("Error when inserting City content!");
        },

        success: function (resposta) {
            $("#container_miolo").html(resposta);

        }


    });

}



function insere_novo_postv2() {



    if ($("#ativo").is(":checked")) {
        var ativo = "true";
    } else {
        var ativo = "false";
    }



    $.ajax({
        dataType: "html",
        url: "blogv2/insere_novo_post.php",
        type: 'POST',
        data: {

            classif: $("#classif").val(),
            data_post: $("#data_post").val(),
            titulo: $("#titulo").val(),
            descritivo_blumar: $("#descritivo_blumar").val(),
            descritivo_be: $("#descritivo_be").val(),
            foto_capa: $("#foto_capa").val(),
            foto_topo: $("#foto_topo").val(),
            url_video: $("#url_video").val(),
            meta_description: $("#meta_description").val(),
            citie: $("#citie").val(),
            regiao: $("#regiao").val(),
            ativo: ativo




        },

        error: function () {
            alert("Error when inserting City content!");
        },

        success: function (resposta) {
            $("#container_miolo").html(resposta);

        }


    });

}




function altera_postv2() {

    $.ajax({
        dataType: "html",
        url: "blogv2/form_altera_post.php",
        type: 'POST',
        data:
        {
            pk_blognacional: $("#pk_blognacional").val()
        },
        error: function () {
            alert("Error when inserting City content!");
        },

        success: function (resposta) {
            $("#container_miolo").html(resposta);

        }


    });

}



function alteracao_postv2() {
    // garanta que o conteúdo do editor vá no POST
    var descritivo_blumar = (typeof tinymce !== 'undefined' && tinymce.get('descritivo_blumar'))
        ? tinymce.get('descritivo_blumar').getContent()
        : $("#descritivo_blumar").val();

    var descritivo_be = (typeof tinymce !== 'undefined' && tinymce.get('descritivo_be'))
        ? tinymce.get('descritivo_be').getContent()
        : $("#descritivo_be").val();

    var ativo = $("#ativo").is(":checked") ? true : false;

    $.ajax({
        url: "blogv2/update_post.php",
        type: "POST",
        data: {
            classif: $("#classif").val(),
            data_post: $("#data_post").val(),
            titulo: $("#titulo").val(),
            descritivo_blumar: descritivo_blumar,   // << ESSENCIAL
            descritivo_be: descritivo_be,           // << ESSENCIAL
            foto_capa: $("#foto_capa").val(),
            foto_topo: $("#foto_topo").val(),
            url_video: $("#url_video").val(),
            meta_description: $("#meta_description").val(),
            pk_blognacional: $("#pk_blognacional").val(),
            citie: $("#citie").val(),
            regiao: $("#regiao").val(),
            ativo: ativo
        },
        success: function (html) { $("#container_miolo").html(html); },
        error: function () { alert("Erro ao atualizar post."); }
    });
}



