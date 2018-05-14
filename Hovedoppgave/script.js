(function($){
    $(document).ready(() => {
        getForm();
    });
})(jQuery);
    
function submitForm(){

    
    var formVal = {
        fn: $('input[name=fn]').val(),
        en: $('input[name=en]').val(),
        ep: $('input[name=ep]').val(),
        tlf: $('input[name=tlf]').val(),
        fd: $('input[name=fd]').val()
    }
    $('#form input').removeClass("error");
    $('.error').text("");
    if(valiFn(formVal.fn) && valiEn(formVal.en) && valiTlf(formVal.tlf)){
        $.ajax( {
            type: 'post',
            url: 'dbpost.php',
            data: formVal,
            error: function(XMLHttpRequest, textStatus, errorThrown){
                alert(XMLHttpRequest.responseText, errorThrown);
            },
            success: function(rawData) {
                console.log(rawData);
                if (rawData != undefined && rawData != ""){
                var data;
                data = JSON.parse(rawData);
                    data.forEach(row => {
                        switch (row.error.code) {
                            case 1:
                                $('input[name="ep"]').toggleClass("error");
                                $('#eperr').text("Ugyldig epostadresse");
                                break;
                            case 2:
                                $('input[name="tlf"]').toggleClass("error");
                                $('#tlferr').text("Ugyldig telefonnummer");
                                break;
                            case 3:
                                $('input[name="fd"]').toggleClass("error");
                                $('#fderr').text("Ugyldig fødselsdato");
                                break;
                            case 4:
                                $('input[name="fd"]').toggleClass("error");
                                $('#fderr').text("Du er for ung");
                                break;
                            case 5:
                                $('input[name="tlf"]').toggleClass("error");
                                $('#tlferr').text("Telefonnummer ikke i listen");
                                break;
                        }
                    });
                }
                getForm()
            }
        });
    }
}

function getForm() {    
    $.ajax( {
        type: 'post',
        url: 'dbget.php',
        data: {status: 1, periode: 30},
        error: function(XMLHttpRequest, textStatus, errorThrown){
            alert(XMLHttpRequest.responseText, errorThrown);
        },
        success: function(rawData) {
            var data;
            data = JSON.parse(rawData);
            if (undefined !== data){
                $("#entries tbody").empty();
                $("#entries tbody").append("<tr class='header'><th>Fornavn</th><th>Etternavn</th><th>E-post</th><th>Telefon</th><th>Fødselsdato</th></tr>");
                data.forEach(row => {
                    var tr = $("<tr>");
                    $.each(row, (key, val) => {
                        tr.append("<td>" + val + "</td>");
                    });
                    $('#entries tbody').append(tr);
                });
            }
        }
    });
}

function valiFn(fornavn) {
    var fn = ((fornavn != undefined) ? true : false);
    if(!fn) {
        $('input[name="fn"]').toggleClass("error");
        $('#eperr').text("Ugyldig fornavn");
    }
    return fn;
}

function valiEn(etternavn) {
    var en = ((etternavn.split(" ").length > 1) ? false : true);
    if(!en) {
        $('input[name="en"]').toggleClass("error");
        $('#enerr').text("Ugyldig etternavn");
    }
    return en;
}

function valiTlf(telefonnummer) {
    var tlf = ((telefonnummer.length == 8) ? true : false);
    if (!tlf) {
        $('input[name="tlf"]').toggleClass("error");
        $('#tlferr').text("Telefonnummeret har feil lengde");
    }
    return tlf;
}