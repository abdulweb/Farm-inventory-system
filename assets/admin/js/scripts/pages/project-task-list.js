/*=========================================================================================
    File Name: project-task-list.js
    Description: Project task datables configurations
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
   Version: 3.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

// function for Check All
$('.input-chk-all').on('click', function(){
 checkboxes = document.getElementsByClassName('input-chk');
 for(var i=0, n=checkboxes.length;i<n;i++) {
   checkboxes[i].checked = source.checked;
 }
});


$(document).ready(function() {
    /********************************************
    *        js of Order by the grouping        *
    ********************************************/

    var groupingTable = $('.row-grouping').DataTable({
        responsive: false,
        autoWidth: false,
        rowReorder: true,
        "columnDefs": [
            { "visible": false, "targets": 2 },
            { "orderable": true, "className": 'reorder', "targets": 0 },
            { "orderable": false, "targets": '_all' }
        ],
        // "order": [[ 2, 'desc' ]],
        "displayLength": 10,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="8">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    } );

    $('.row-grouping tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === 2 && currentOrder[1] === 'asc' ) {
            table.order( [ 2, 'desc' ] ).draw();
        }
        else {
            table.order( [ 2, 'asc' ] ).draw();
        }
    } );

    $('select').select2();

    // Checkbox & Radio 1
    $('.icheck input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
    });

    $('#project-task-list').on( 'draw.dt', function () {
        // Checkbox & Radio 1
        $('.icheck input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
        });
    } );

    //TODO:AJ: Improve check uncheck all func
    var checkAll = $('input.input-chk-all');
    var checkboxes = $('input.input-chk');

    checkAll.on('ifChecked ifUnchecked', function(event) {        
        if (event.type == 'ifChecked') {
            checkboxes.iCheck('check');
        } else {
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function(event){
        if(checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

});