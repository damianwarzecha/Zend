
$( document ).ready(function() {



    // showUsersList();

    $("#data_panel").on('click', '#zagraj', function () {
        var user = this.value;
        // alert(user);
        $.ajax({
            url:"rozdaj",//?name="+user,
            method:"POST",
            data:{button_type:"user", user:user},
            dataType:"json",
            success: function (data){
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

    //
    // var worker = new Worker("showUsers.js");
    //
    // worker.onmessage = function (oEvent) {
    //     console.log("Wywolanie zwrotne przez watek")
    // }

    function check() {
        showUsersList();
        setTimeout(function () {
            check();
        },60000);
    }

    check();


    $('#rozdaj').click(function () {
        $.ajax({
            url:"rozdaj",
            method:"POST",
            data:{},
            dataType:"json",
            success: function (data){
                // var string = "\"img/karty/" + data.card + "\"";
                // $('#gracz').append('<img src='+string+' width="130" height="200">');
                //

                $.each(data.card, function (i, card) {
                    var string = "\"img/karty/" + card + "\"";
                    $('#gracz').append('<img id="'+card+'" src='+string+' width="130" height="200">');
                });
            }
        });
    });


    $("#gracz").on('click', 'img', function () {
        $("#pole").empty();
        var card = this.value;

        this.remove();
        var string = "\"img/karty/" + this.id + "\"";
        $('#pole').append('<img id="'+card+'" src='+string+' width="130" height="200">');

        // alert(user);
        // $.ajax({
        //     url:"ajaxIndex?name="+user,
        //     method:"DELETE",
        //     data:{button_type:"user", del_user:user},
        //     dataType:"json",
        //     success: function (data){
        //         showUsersList();
        //         // $.ajax({
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
            // }
        // });
    });

});


