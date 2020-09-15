function delegate(i,j,tag,that) {
    that.parent().parent().parent().remove();
    $.ajax({
        type: "POST",
        url: "/ajax/delegate.php",
        data: ( {"i" : i, "j": j, "tag": tag} ),
        success: function(html){

        }
    });

}
