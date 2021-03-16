function request(group_id) {
    $.ajax({
        type: "GET",
        url: "/ajax/user_request_group.php",
        data: ( {"group_id" : group_id} ),
        success: function(html){
            window.location.href=window.location.href;
        }
    });


}