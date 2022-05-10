$(document).ready(function(){
    //$("#mesg").hide();

var id_live = $("#idlivestream").val();

console.log(id_live);

    $("#send-btn").on("click", function(){
        $value = $("#data").val();
        //$msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+'Gamer :'+ $value +'</p></div></div>';
      //  $(".form").append($msg);
        $("#ecrire_comm").hide();
        $("#data").val('');

        // start ajax code
var value=$("#data").val();
            $.ajax({
                url: '/student/ajax',
                type: 'POST',
                data:{'text':$value,id_live:id_live},
                dataType: 'json',
                async: true,

                success: function(data, status) {
                    if (data == "il faut pas dire de gros mots"){
                       $("#badwords").show();
                        $("#erreur").show();
                      //  $("#erreur").append('<p id="mesgerreur"class="text-danger">fdfdfdfdfdfdfdfdf</p>');
                       $("#data").css('border', '2px solid red')
                    }else {
                        $replay = '<div class="bot-inbox inbox"><div class="msg-header"><p>' + 'Gamer :' + data + '</p></div></div>';
                        $(".form").append($replay);
                     //   $("#erreur").remove("p");
                        $("#badwords").hide();
                        $("#erreur").hide();
                        $("#data").css('border', 'none');

                        $("#data").css('border-bottom', '3px solid silver');
                        $("#data").css('outline-color', 'silver');

                    }
                }

                });


                });
});