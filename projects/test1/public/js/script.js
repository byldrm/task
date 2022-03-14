$('.api').change(function (){
    let api = $(this).val();
    let url = $('.api_lists').data('url');
    let token = $("meta[name='csrf-token']").attr("content");
    if(api){
        $.ajax({
            url: url,
            type: 'POST',
            data: {api:api, _token: token},
            dataType: "json",
            success: function (response){
                $('.user_list').html(response);
            }
        })
    }else{
        $('.user_list').html('');
    }

})
