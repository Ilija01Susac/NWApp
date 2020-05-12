    $(document).ready(function(){
        $('tr').mouseover(function(){
            var valueOfTd = $(this).find('td:parent').text();

            $(this).tooltip({
              content : valueOfTd,
            });

        });
    });
