var invoiceList = $('#invoice-list').DataTable({
    "dom": "<'inv-list-top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'l<'dt-action-buttons align-self-center'B>><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f<'toolbar align-self-center'>>>>" +
        "<'table-responsive'tr>" +
        "<'inv-list-bottom-section d-sm-flex justify-content-sm-between text-center'<'inv-list-pages-count  mb-sm-0 mb-3'i><'inv-list-pagination'p>>",

    // headerCallback:function(e, a, t, n, s) {
    //     e.getElementsByTagName("th")[0].innerHTML=`
    //     <div class="form-check form-check-primary d-block new-control">
    //         <input class="form-check-input chk-parent" type="checkbox" id="form-check-default">
    //     </div>`
    // },
    columnDefs:[{
        targets:0,
        width:"30px",
        className:"",
        orderable:!1,
        // render:function(e, a, t, n) {
        //     return `
        //     <div class="form-check form-check-primary d-block new-control">
        //         <input class="form-check-input child-chk" type="checkbox" id="form-check-default">
        //     </div>`
        // },
    }],
    buttons: [
        // {
        //     text: 'Add New',
        //     className: 'btn btn-primary',
        //     action: function(e, dt, node, config ) {
        //         window.location = 'app-invoice-add.html';
        //     }
        // }
    ],
    "order": [[ 1, "asc" ]],
    "oLanguage": {
        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
        "sInfo": "Showing page _PAGE_ of _PAGES_",
        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        "sSearchPlaceholder": "Search...",
        "sLengthMenu": "Results :  _MENU_",
    },
    "stripeClasses": [],
    "lengthMenu": [10, 20, 50],
    "pageLength": 10
});

$("div.toolbar").html(`
<button class="dt-tambah btn btn-primary" tabindex="0" aria-controls="invoice-list"><span>Tambah</span></button>
`);

multiCheck(invoiceList);

var base_url = window.location.origin;

$('.dt-tambah').on('click', function() {
    window.location = base_url + '/penugasan/create' 
});

$('.dt-tambah').on('click', function() {
    $('#santriModal').modal('show');
    $('#exampleModalLabel').html('Tambah User');
    $('#saldo').hide(); 
});

$('.dt-import').on('click', function() {
    $('#importModal').modal('show');
});

$('body').on('click', '#btnStatus', function (event) {
    
    var id = $(this).data('id');
    var status = $(this).data('status');    
    var note = $(this).data('note');
    
    $('#changeStatus').attr('action', '/penugasan/setting/' + id);
    $("#note").val(note);
    if (status == 'approve') {
        document.getElementById("approval_yes").checked = true;
    } else if (status == 'not approve') {        
        document.getElementById("approval_no").checked = true;
        document.getElementById("noted").style.display = "block";
    }
    $('#exampleModal').modal('show');
});

function myApproval() {
    var note = $('input[name="status"]:checked').val();
    var x = document.getElementById("noted");
    if (note == 'not approve') {
        x.style.display = "block";
    }else{
        x.style.display = "none";
    }
    
}

$('#not_approve').on('click', function() {
    var data = $(this).data('data');
    $("#text").text(data)
});

$(".point-text").text(function(i, txt) {
    return txt.substring(0,100) + (txt.length > 100 ? '...' : '');
});


// $('.action-delete').on('click', function() {
//     $(this).parents('tr').remove();
// })