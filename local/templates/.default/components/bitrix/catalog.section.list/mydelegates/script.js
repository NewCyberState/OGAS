function delegate(i,j,tag,that) {
    that.removeClass("bg-primary").addClass("bg-light").html("Освободить делегата");
    that.attr("onClick","undelegate("+i+","+j+","+tag+",$(this))");
    $.ajax({
        type: "POST",
        url: "/ajax/delegate.php",
        data: ( {"i" : i, "j": j, "tag": tag} ),
        success: function(html){

        }
    });

}
function undelegate(i,j,tag,that) {
    that.removeClass("bg-light").addClass("bg-primary").html("Назначить делегата");
    that.attr("onClick","delegate("+i+","+j+","+tag+",$(this))");
    $.ajax({
        type: "POST",
        url: "/ajax/undelegate.php",
        data: ( {"i" : i, "j": j, "tag": tag} ),
        success: function(html){

        }
    });

}
