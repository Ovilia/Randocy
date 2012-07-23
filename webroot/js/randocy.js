$(function(){
});

function showDetail(doubanId) {
    $.get(
        "detail.php",
        {
            "doubanId": doubanId
        },
        function(data, textStatus) {
            $("#detailPanel").html(data);
            $("#detailPanel").animate({
                left: 820
            }, 1000);
        }
    );
}

function hideDetail() {
	$("#detailPanel").animate({
		left: 500
	}, 1000);	
}

function hideMovie(url, movieDiv) {
        $.get(
        "hide.php",
        {
            "url": url
        },
        function(data, textStatus) {
            $("#" + movieDiv).fadeOut();
        }
    );
}
