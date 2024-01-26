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
    var language = $('input[name="language"]:checked').val();
    const myLang = language.split("-");
    if (myLang[1] == 'EN') {
        $('#datalistTahap').html(`<option wire:click="pickStep('Before the consulting project work')">Before Project</option>
        <option wire:click="pickStep('After the consulting project work')">After Project</option>
        <option wire:click="pickStep('Before Halal Audit')">Before Audit</option>
        <option wire:click="pickStep('After Issuing Halal Certificate')">After Issued Certificate</option>`);

        $('#datalistAktifitas').html(`<option wire:click="pickActivity('SJPH Manual and Procedure Development')">SJPH Manual and Procedure</option>
        <option wire:click="pickActivity('SJPH Implementation')">SJPH Implementation</option>
        <option wire:click="pickActivity('Halal Certification Registration at BPJPH and LPH')">Halal Certification Registration</option>
        <option wire:click="pickActivity('LPH Audit and Settlement of MUI Halal Decrees')">LPH Audit and Settlement</option>`);

        $('#datalistKeterangan').html(`<option wire:click="pickService('IHATEC SJPH Training Fee')">IHATEC SJPH Training Fee</option>
        <option wire:click="pickService('BLU BPJPH Fee and Certification Fee at LPH')">BLU BPJPH Fee &amp; LPH</option>`);
    } else {
        $('#datalistTahap').html(`<option value="Sebelum pelaksanaan projek konsultasi">
        <option value="Setelah pelaksanaan projek konsultasi">
        <option value="Sebelum Audit Halal">
        <option value="Setelah Terbit Sertifikat Halal">`);

        $('#datalistAktifitas').html(`<option wire:click="pickActivity('Pengembangan Manual dan Prosedur SJPH')">Pengembangan Manual</option>
        <option wire:click="pickActivity('Mulai Implementasi SJPH')">Mulai Implementasi SJPH</option>
        <option wire:click="pickActivity('Pendaftaran Sertifikasi Halal di BPJPH dan LPH')">Pendaftaran Sertifikasi Halal</option>
        <option wire:click="pickActivity('Audit LPH dan Penyelesaian Ketetapan Halal MUI')">Audit LPH dan Penyelesaian</option>
        <option wire:click="pickActivity('Pendampingan Sertifikasi Halal')">Pendampingan Sertifikasi Halal</option>`);

        $('#datalistKeterangan').html(`<option wire:click="pickService('Biaya Training SJPH IHATEC')">Biaya Training SJPH IHATEC</option>
        <option wire:click="pickService('Biaya BLU BPJPH dan Biaya Sertifikasi di LPH')">Biaya BLU BPJPH/LPH</option>`);
    }
    const obj = JSON.parse(lang)
    console.log(obj)
    var a = [];
    for (let i = 0; i < obj.length; i++) {
        a[i] = `<tr><input type="hidden" name="textscope_id[${i}]" value="${obj[i].id}"><input type="hidden" name="criteria[${i}]" value="${obj[i].criteria}"><input type="hidden" name="text[${i}]" value="${obj[i].text}"><input type="hidden" name="activity[${i}]" value="${obj[i].activity}"><input type="hidden" name="type[${i}]" value="${obj[i].type}"><td>${obj[i].activity}</td><td>${obj[i].type}</td><td><input type="text" name="mandays[]" value="" class="form-control form-control-sm mandays" placeholder="Mandays"></td></tr>`;
    }
    var b = [];
    b[0] = "<tr><td>Total Count Mandays</td><td colspan='2' id='sumMandays' class='text-center'>(Sum Mandays)</td></tr>";
    const tbody = a.concat(b);
    $("#tbody-lang").html(tbody);
    
}

function myCurrency() {
    var currency = $('input[name="currency"]:checked').val();    
    $(".currencyName").text(currency + ' '); 
    
    var nominal = $('#nominal').val();
    if (nominal) {
        $('#nominal').keyup();        
    }
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
    let nomimal = $(this).val();
    // Menghapus karakter non-digit dari input
    const cleanNumberValue = (value) => {
        return value.replace(/[^0-9]/g, '');
    };
    // Format angka menjadi format Rupiah
    // const formatRupiah = (value) => {
    //   const formatter = new Intl.NumberFormat('id-ID', {
    //     style: 'currency',
    //     currency: 'IDR'
    //   });

    //   return formatter.format(value);
    // };
    let value1 = cleanNumberValue(nomimal);
    var currency = $('input[name="currency"]:checked').val();   
    let total = 0;    
    if (currency == 'USD') {
        $.get(`change_currency_nominal/?nominal=${value1}`, function (data) {        
            let nominal_real = data.nominal; 

            let totalMandays = $('#sumMandays').text();
            total = totalMandays * parseInt(nominal_real);
            let min = total - (totalMandays * 2500000);   
            let max = total - (totalMandays * 1000000);   
            $("#sebelum_diskon").val(total);
            $("#setelah_diskon").val(total);
            $("#biaya_final").val(total);
            $("#min_profit").val(min);
            $("#max_profit").val(max);
            
         })
    }else{
        let nominal_real = value1;

        let totalMandays = $('#sumMandays').text();
        total = totalMandays * parseInt(nominal_real);
        let min = total - (totalMandays * 2500000);   
        let max = total - (totalMandays * 1000000);   
        $("#sebelum_diskon").val(total);
        $("#setelah_diskon").val(total);
        $("#biaya_final").val(total);
        $("#min_profit").val(min);
        $("#max_profit").val(max);
    }
    

    $('#discount').change();
});

$(document).on('change', '#discount', function() {
    var total = 0;
    var totalMandays = $('#sumMandays').text();
    var sebelumDiskon = $("#sebelum_diskon").val();
    var diskon = (sebelumDiskon * $(this).val()) / 100;
    total = sebelumDiskon - diskon;
    var min = total - (totalMandays * 2500000);   
    var max = total - (totalMandays * 1000000);
    $("#setelah_diskon").val(total);
    $("#biaya_final").val(total);
    $("#min_profit").val(min);
    $("#max_profit").val(max); 
});

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }