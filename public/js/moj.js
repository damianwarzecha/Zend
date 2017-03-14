/**
 * Created by damian.warzecha on 2016-08-12.
 */

/**
 * sprawdzenie czy dany text występuje w bazie za pomocą ajax, jquery
 */

$(document).ready(function () {

    validateInput('[name="reg_login"]', 'login');
    validateInput('[name="email"]', 'email');

    $("#user").click(function () {
        showUsersList()
        // $('#data_panel').html('Test');
        // $.ajax({
        //     url:"ajaxIndex",
        //     method:"POST",
        //     data:{button_type:"user"},
        //     dataType:"json",
        //     success: function (data){
        //         $('#data_panel').html("");
        //         $.each(data.users, function (i, user) {
        //             $.each(user , function (j, elem) {
        //                 $('#data_panel').append(" <div class='col-md-3'> " + elem + " </div> ");
        //             });
        //             $('#data_panel').append("<button type='button' id='del' value='"+user[0]+"'>Usuń</button>");
        //             $('#data_panel').append("<br>");
        //         })
        //     }
        // });
    });


    $("#data_panel").on('click', '#del', function () {
        var user = this.value;
        // alert(user);
        $.ajax({
            url:"ajaxIndex?name="+user,
            method:"DELETE",
            data:{button_type:"user", del_user:user},
            dataType:"json",
            success: function (data){
                showUsersList();
                // $.ajax({
                //     url:"ajaxIndex",
                //     method:"POST",
                //     data:{button_type:"user"},
                //     dataType:"json",
                //     success: function (data){
                //         showUsersList(data);
                        // $('#data_panel').html("");
                        // $.each(data.users, function (i, user) {
                        //     $.each(user , function (j, elem) {
                        //         $('#data_panel').append(" <div class='col-md-3'> " + elem + " </div> ");
                        //     });
                        //     $('#data_panel').append("<button type='button' id='del' value='"+user[0]+"'>Usuń</button>");
                        //     $('#data_panel').append("<br>");
                        //
                        // })
                    // }
                // });
            }
        });
    });


    // click(function () {
    //     //var user = this.value;
    //
    // });
    //     $.ajax({
    //         url:"ajaxIndex",
    //         method:"POST",
    //         data:{button_type:"user"},
    //         dataType:"json",
    //         success: function (data){
    //             $('#data_panel').innerHTML('Test');
    //         }
    //     })
    // );
    // $('[name="reg_login"]').keyup(function () {
    //     var username = $(this).val();
    //     $.ajax({
    //         url:"ajax",
    //         method:"POST",
    //         data:{user_name:username},
    //         dataType:"json",
    //         success: function (data)
    //         {
    //             $('[name="reg_login"]').parent().removeClass("has-error has-feedback");
    //             $('[name="reg_login"]').parent().addClass("has-success has-feedback");
    //             $('#test').replaceWith('<label id="test">'+data.html+'</label>');
    //             $('[name="reg_login"]').attr('id', 'inputSuccess2');
    //             $('.glyphicon').remove();
    //             $('<span class="glyphicon glyphicon-ok form-control-feedback"></span>').insertAfter('[name="reg_login"]');
    //         },
    //         error: function (data)
    //         {
    //             $('[name="reg_login"]').parent().removeClass("has-success has-feedback");
    //             $('[name="reg_login"]').parent().addClass("has-error has-feedback");
    //             $('#test').replaceWith('<label id="test">'+data.html+'test'+'</label>');
    //             $('[name="reg_login"]').attr('id', 'inputError2');
    //             $('.glyphicon').remove();
    //             $('<span class="glyphicon glyphicon-remove form-control-feedback"></span>').insertAfter('[name="reg_login"]');
    //         }
    //     });
    // });
});

function showUsersList() {
    // $("#user").click(function () {
        // $('#data_panel').html('test');
        $.ajax({
            url:"ajaxIndex",
            method:"POST",
            data:{button_type:"user"},
            dataType:"json",
            success: function (data){
                $('#data_panel').html("");
                $.each(data.users, function (i, user) {
                    $.each(user , function (j, elem) {
                        $('#data_panel').append(" <div class='col-md-3'> " + elem + " </div> ");
                    });
                    $('#data_panel').append("<button type='button' id='del' value='"+user[0]+"'>Usuń</button>");
                    $('#data_panel').append("<br>");
                })
            }
        });
    // });
}

function validateInput(input, inputType) {
    $(input).keyup(function () {
        var input_str = $(this).val();
        $.ajax({
            url:"ajax",
            method:"POST",
            data:{input_data:input_str, input_type:inputType},
            dataType:"json",
            success: function (data)
            {
                // alert(data.user);
                if (data.user === false)
                {
                    $(input).parent().removeClass("has-success has-feedback");
                    $(input).parent().addClass("has-error has-feedback");
                    $('#test').replaceWith('<label id="test">'+data.html+'Test'+'</label>');
                    $(input).attr('id', 'inputError2');
                    $('.glyphicon').remove();
                    $('<span class="glyphicon glyphicon-remove form-control-feedback"></span>').insertAfter(input);
                }
                else
                {
                    $(input).parent().removeClass("has-error has-feedback");
                    $(input).parent().addClass("has-success has-feedback");
                    $('#test').replaceWith('<label id="test">'+data.html+'</label>');
                    $(input).attr('id', 'inputSuccess2');
                    $('.glyphicon').remove();
                    $('<span class="glyphicon glyphicon-ok form-control-feedback"></span>').insertAfter(input);
                }
            },
            error: function (data)
            {
                alert('nieznany błąd');
                // $(input).parent().removeClass("has-success has-feedback");
                // $(input).parent().addClass("has-error has-feedback");
                // $('#test').replaceWith('<label id="test">'+data.html+'test'+'</label>');
                // $(input).attr('id', 'inputError2');
                // $('.glyphicon').remove();
                // $('<span class="glyphicon glyphicon-remove form-control-feedback"></span>').insertAfter(input);
            }
        });
    });
}