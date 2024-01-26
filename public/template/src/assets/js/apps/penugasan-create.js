/**
 * ===================================
 *    Product Description Editor 
 * ===================================
*/

// The DOM element you wish to replace with Tagify
var input = document.querySelector('input[name=basic]');

// initialize Tagify on the above input node reference
new Tagify(input)

var base_url = window.location.origin;
var current =window.location.pathname.split("/");

var id = $('#id_store').val();
if (current[2] == String(id)) {    
    $('#addForm').attr('action', '/document/revise/' + id);
}

var quill = new Quill('#product-description', {
    modules: {
        toolbar: [
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline'],
        ['image', 'code-block']
        ]
    },
    placeholder: 'Write product description...',
    theme: 'snow'  // or 'bubble'
});

$("#button-addon2").click(function(){ 
    var html = $(".clone").html();
    $(".increment").after(html);
});

$("body").on("click",".btn-danger",function(){ 
    $(this).parents(".control-group").remove();
});

function create_tr(table_id) {
    let table_body = document.getElementById(table_id),
        first_tr   = table_body.firstElementChild
        tr_clone   = first_tr.cloneNode(true);

    table_body.append(tr_clone);

    clean_first_tr(table_body.firstElementChild);
}

function clean_first_tr(firstTr) {
    let children = firstTr.children;
    
    children = Array.isArray(children) ? children : Object.values(children);
    children.forEach(x=>{
        if(x !== firstTr.lastElementChild)
        {
            x.firstElementChild.value = '';
        }
    });
}



function remove_tr(This) {
    if(This.closest('tbody').childElementCount == 1)
    {
        alert("Silahkan tambah baris terlebih dahulu");
    }else{
        This.closest('tr').remove();
    }
}

function myLang() {
    var lang = $('input[name="language"]:checked').attr("data-lang");
    const obj = JSON.parse(lang)
    console.log(obj)
    var a = [];
    for (let i = 0; i < obj.length; i++) {
        a[i] = `<tr><input type="hidden" name="criteria[${i}]" value="${obj[i].criteria}"><input type="hidden" name="text[${i}]" value="${obj[i].text}"><input type="hidden" name="activity[${i}]" value="${obj[i].activity}"><input type="hidden" name="type[${i}]" value="${obj[i].type}"><td>${obj[i].activity}</td><td>${obj[i].type}</td><td><input type="text" name="mandays[]" value="" class="form-control form-control-sm mandays" placeholder="Mandays"></td></tr>`;
    }
    var b = [];
    b[0] = "<tr><td>Total Count Mandays</td><td colspan='2' id='sumMandays' class='text-center'>(Sum Mandays)</td></tr>";
    const tbody = a.concat(b);
    $("#tbody-lang").html(tbody);
    
}

function myCurrency() {
    var currency = $('input[name="currency"]:checked').val();    
    $(".currencyName").text(currency + ' ');    
    // if (currency == 'USD') {
    //     var estimasi_min = $('#estimasi_min').val();
    //     var estimasi_max = $('#estimasi_max').val();
    //     $.get(`change_currency/?min=${estimasi_min}&max=${estimasi_max}`, function (data) {        
    //         console.log(data);            
    //      })
    // }
    
}

function myPPN() {
    var ppn = $('input[name="ppn_tax"]:checked').val();
    var totalMandays = $('#sumMandays').text();

    if (ppn == 1) {
        var setelahDiskon = parseFloat($("#setelah_diskon").val());
        var nilaiPpn = (setelahDiskon * 11) / 100;
        var total = setelahDiskon + nilaiPpn;
        var min = total - (totalMandays * 2500000);   
        var max = total - (totalMandays * 1000000);      

        $("#biaya_final").val(total);
        $("#min_profit").val(min);
        $("#max_profit").val(max);
    }else{
        var total = $("#setelah_diskon").val();
        var min = total - (totalMandays * 2500000);   
        var max = total - (totalMandays * 1000000);      

        $("#biaya_final").val(total);
        $("#min_profit").val(min);
        $("#max_profit").val(max);
    }
    
}

$(document).on('keyup', '.mandays', function() {  
    var total = 0;
    $('.mandays').each(function() {        
        var value = parseFloat($(this).val()) || 0;
        total += value;      
    });
    $('#sumMandays').text(total);
    $('#total_mandays').val(total);    
    $('#nominal').keyup();
});

$(document).on('keyup', '#nominal', function() {  
    var total = 0;    
    var totalMandays = $('#sumMandays').text();
    total = totalMandays * $(this).val();
    var min = total - (totalMandays * 2500000);   
    var max = total - (totalMandays * 1000000);   
    $("#sebelum_diskon").val(total);
    $("#setelah_diskon").val(total);
    $("#biaya_final").val(total);
    $("#min_profit").val(min);
    $("#max_profit").val(max);
});

$(document).on('change', '#document_id', function() {
    var id = $(this).val();
    var lang = $(this).find(':selected').data('lang');
    $("#language").val(lang)
    
    $.get('/penugasan/scope_works/' + id, function (data) {           
        var a = [];
        var b = [];
        for (let index = 0; index < data.user.length; index++) {
            b[index] = `<option value="${data.user[index].id}">${data.user[index].full_name}</option>`;            
        }        
        for (let i = 0; i < data.data.length; i++) {
            a[i] = `<tr><input type="hidden" name="scope_work_id[${i}]" value="${data.data[i].id}"><td>${data.data[i].text_scope_work.activity}</td><td class="text-center">${data.data[i].mandays}</td><td><select name="user_id[${i}]" class='form-control'><option>- Pilih -</option>${b}</select></td></tr>`;
        }
        const tbody = a;
        $("#tbody-lang").html(tbody);
     })
});

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}