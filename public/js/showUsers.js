/**
 * Created by ja on 05.03.2017.
 */
function showUsersList() {
    // $("#user").click(function () {
    // $('#data_panel').html('Dupa');
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
                if (user[1]==0){
                    $('#data_panel').append("<button type='button' id='zagraj' disabled value='"+user[0]+"'>Zagraj</button>");
                    $('#data_panel').append("<button type='button' id='zagraj' disabled value='"+user[0]+"'>Zrezygnuj</button>");
                    $('#data_panel').append("<br>");
                } else {
                    $('#data_panel').append("<button type='button' id='zagraj' value='"+user[0]+"'>Zagraj</button>");
                    $('#data_panel').append("<button type='button' id='zagraj' value='"+user[0]+"'>Zrezygnuj</button>");
                    $('#data_panel').append("<br>");
                }

            })
        }
    });
    // });
}

// function game() {
//     $.ajax(
//         {
//             url:
//         }
//     );
// }
