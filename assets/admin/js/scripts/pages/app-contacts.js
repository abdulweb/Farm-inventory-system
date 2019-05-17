/*=========================================================================================
    File Name: users-contacts.js
    Description: Users contacts configurations
    ----------------------------------------------------------------------------------------
    Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
    Version: 3.0
    Author: GeeksLabs
    Author URL: http://www.themeforest.net/user/geekslabs
==========================================================================================*/

$.fn.raty.defaults.path = '../../../app-assets/images/raty/';

$(document).ready(function() {

    if($('.sidebar-detached.sidebar-left').length > 0){
        var sidebar_fixed = new PerfectScrollbar('.sidebar-detached.sidebar-left',{
            wheelPropagation: false,
        });
    }

    var userDataTable = $('#users-contacts').DataTable({
        'order' : [[1,'']]
    });
    // Set the search textbox functionality in sidebar
    $('#search-contacts').on( 'keyup', function () {
        userDataTable.search( this.value ).draw();
    });
    
    // Checkbox & Radio 1
    $('.input-chk').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
    });
        
    userDataTable.on( 'draw.dt', function () {
        // Checkbox & Radio 1
        $('.input-chk').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
        });

        // Favorite initialization and usage
        $('.favorite').on('click', function(){
            $(this).toggleClass('active');
            $('.favorite').raty({
                number: 1,
                hints: ['Favorite']
            });
            $('.favorite.active').raty({
                number: 1,
                hints: ['Favorite'],
                score: 1
            });
        });
        $('.favorite').raty({
            number: 1,
            hints: ['Favorite']
        });
        $('.favorite.active').raty({
            number: 1,
            hints: ['Favorite'],
            score: 1
        });
    });

    $('.favorite').on('click', function(){
        $(this).toggleClass('active');
        $('.favorite').raty({
            number: 1,
            hints: ['Favorite']
        });
        $('.favorite.active').raty({
            number: 1,
            hints: ['Favorite'],
            score: 1
        });
    });
    $('.favorite').raty({
        number: 1,
        hints: ['Favorite']
    });
    $('.favorite.active').raty({
        number: 1,
        hints: ['Favorite'],
        score: 1
    });

    // Add new contact
    var counter = 1;
 
    $('#add-contact-item').on( 'click', function (e) {
        e.preventDefault();
        var name = $("#contact-name").val();
        var email = $("#contact-email").val();
        var contact = $("#contact-phone").val();
        var image = $("#user-image").val();
        var fav = $("#favorite:checked").val(),
        favClass = "";
        console.log('image');
        console.log(image);
        if(fav == 'on'){
            favClass = " active";
        }

        userDataTable.row.add( [
            '<input type="checkbox" class="input-chk check">',
            '<div class="media">'+
                '<div class="media-left pr-1"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="../../../app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>'+
                '<div class="media-body media-middle">'+
                    '<a class="name" class="media-heading">'+name+'</a>'+
                '</div>'+
            '</div>',
            '<a class="email" href="'+email+'">'+email+'</a>',
            '<span class="phone">'+contact+'</span>',
            '<div class="favorite '+favClass+'"></div>',
            '<a data-toggle="modal" data-target="#EditContactModal" class="primary edit mr-1"><i class="la la-pencil"></i></a>'+
                '<a class="danger delete mr-1"><i class="la la-trash-o"></i></a>'+
                '<span class="dropdown">'+
                    '<a id="btnSearchDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="dropdown-toggle dropdown-menu-right"><i class="la la-ellipsis-v"></i></a>'+
                    '<span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">'+
                        '<a data-toggle="modal" data-target="#EditContactModal" class="dropdown-item edit"><i class="ft-edit-2"></i> Edit</a>'+
                        '<a href="#" class="dropdown-item delete"><i class="ft-trash-2"></i> Delete</a>'+
                        '<a href="#" class="dropdown-item"><i class="ft-plus-circle primary"></i> Projects</a>'+
                        '<a href="#" class="dropdown-item"><i class="ft-plus-circle info"></i> Team</a>'+
                        '<a href="#" class="dropdown-item"><i class="ft-plus-circle warning"></i> Clients</a>'+
                        '<a href="#" class="dropdown-item"><i class="ft-plus-circle success"></i> Friends</a>'+
                    '</span>'+
                '</span>'
        ] ).draw( false );
 
        counter++;
    } );

    var currentRow = null;

    $(document).on('click', '.edit', function () {
        currentRow= $(this).parents('tr');
        $("#phone").val("");
        $("#name").val($(this).closest('tr').find('td .name').text());
        $("#email").val($(this).closest('tr').find('.email').text());
        $("#phone").val($(this).closest('tr').find('td.phone', 'td .phone').text());
        $("#fav").val('');
        if($(this).closest('tr').find('.favorite').hasClass('active')){
            $("#fav").text('active');
        }
    });
    // Edit item
    $('#edit-contact-item').on( 'click', function (e) {
        e.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var contact = $("#phone").val();
        var favClass = $("#fav").text();
        console.log(favClass);

        userDataTable.row(currentRow).data( [
            '<input type="checkbox" class="input-chk check">',
            '<div class="media">'+
                '<div class="media-left pr-1"><span class="avatar avatar-sm avatar-online rounded-circle"><img src="../../../app-assets/images/portrait/small/avatar-s-2.png" alt="avatar"><i></i></span></div>'+
                '<div class="media-body media-middle">'+
                    '<a class="name" class="media-heading">'+name+'</a>'+
                '</div>'+
            '</div>',
            '<a class="email" href="'+email+'">'+email+'</a>',
            '<span class="phone">'+contact+'</span>',
            '<div class="favorite '+favClass+'"></div>',
            '<a data-toggle="modal" data-target="#EditContactModal" class="primary edit mr-1"><i class="la la-pencil"></i></a>'+
                '<a class="danger delete mr-1"><i class="la la-trash-o"></i></a>'+
                '<span class="dropdown">'+
                    '<a id="btnSearchDrop2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="dropdown-toggle dropdown-menu-right"><i class="la la-ellipsis-v"></i></a>'+
                    '<span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">'+
                        '<a data-toggle="modal" data-target="#EditContactModal" class="dropdown-item edit"><i class="ft-edit-2"></i> Edit</a>'+
                        '<a href="#" class="dropdown-item delete"><i class="ft-trash-2"></i> Delete</a>'+
                        '<a href="#" class="dropdown-item"><i class="ft-plus-circle primary"></i> Projects</a>'+
                        '<a href="#" class="dropdown-item"><i class="ft-plus-circle info"></i> Team</a>'+
                        '<a href="#" class="dropdown-item"><i class="ft-plus-circle warning"></i> Clients</a>'+
                        '<a href="#" class="dropdown-item"><i class="ft-plus-circle success"></i> Friends</a>'+
                    '</span>'+
                '</span>'
        ] ).draw( );
 
        counter++;
    } );

    $(".modal").on("hidden.bs.modal", function() {
        $(".modal-body input").val("")
    });

    // Check All checkbox start
    $(document).on("ifClicked", 'input#check-all', function() {
        var checkboxes = $("input.input-chk");
        $(document).on("ifChecked", 'input#check-all', function(event) {
            checkboxes.iCheck("check");
        });
        $(document).on("ifUnchecked", 'input#check-all', function(event) {
            checkboxes.iCheck("uncheck");
        });
    });

    // Delete row
    $('#users-contacts').on("click", ".delete", function(){
        userDataTable.row($(this).parents('tr')).remove().draw();
    });

    $(document).on("click", ".delete-all", function() {
        userDataTable.rows($("#users-contacts").find(".checked").closest("tr")).remove().draw();
        $("input#check-all").iCheck("uncheck");
    });

    // Main menu toggle should hide app menu
    $('.menu-toggle').on('click',function(e){
        $('.app-content .sidebar-left').removeClass('show');
        $('.app-content .content-overlay').removeClass('show');
    });

    // Chat sidebar toggle
    $('.sidebar-toggle').on('click',function(e){
        e.stopPropagation();
        $('.app-content .sidebar-left').toggleClass('show');
        $('.app-content .content-overlay').addClass('show');
    });
    $('.app-content .content-overlay').on('click',function(e){
        $('.app-content .sidebar-left').removeClass('show');
        $('.app-content .content-overlay').removeClass('show');
    });

    // For chat sidebar on small screen
    if ($(window).width() > 992) {
        if($('.app-content .content-overlay').hasClass('show')){
            $('.app-content .content-overlay').removeClass('show');
        }
    }

});

$(window).on("resize", function() {
    // remove show classes from sidebar and overlay if size is > 992
    if ($(window).width() > 992) {
        if($('.app-content .content-overlay').hasClass('show')){
            $('.app-content .sidebar-left').removeClass('show');
            $('.app-content .content-overlay').removeClass('show');
        }
    }
});