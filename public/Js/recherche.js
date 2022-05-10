(function ($){

    $("#myInput").focus().keyup(function(event){

        var input = $(this);
        var val = input.val();

        if (val == ''){
            $('#fil tr').show();
            $('#fil span').removeClass('highlight');
            return true;

        }

        var regexp = '\\b(.*)';

        for (var i in val){

            regexp += '('+val[i]+')(.*)';
        }

        regexp += '\\b';
        $('#fil tr').show();

        $('#fil').find('td>span').each(function (){


            var span= $(this);
            var resultats = span.text().match(new RegExp (regexp,'i'));

            if (resultats){
                var string = '';

                for (var i in resultats){
                    if (i>0){
                        if (i%2 == 0) {
                            string += '<span class="highlight">'+resultats[i]+'</span>';


                        }else {

                            string += resultats[i];
                        }


                    }
                }
                span.empty().append(string);


            }else {

                span.parent().parent().hide();

            }

        })


    });


})(jQuery);