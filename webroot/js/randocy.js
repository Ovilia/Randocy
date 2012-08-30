$(function(){
    var movieCnt = 30;
    var movieEach = 6;
    // load movies when init
    $.get('loadMovie.php', {'isBrief': 'true', 'start': 0, 'count': movieCnt}, function(data) {
        $("#moviePanel").append(data);
    });

    // load image when scroll to end
    $(window).scroll(function () {
        var winH = $(window).height(); //浏览器可视区域页面的高度
        var pageH = $(document.body).height(); //页面总高度   
        var scrollT = $(window).scrollTop(); //滚动条top   
        var ratio = (pageH - winH - scrollT) / winH;
        
        if(ratio < 0.1){
            $.get('loadMovie.php', {'isBrief': 'true', 'start': movieCnt, 'count': movieEach}, function(data) {
                $("#moviePanel").append(data);
            });
            movieCnt += movieEach;
        }
    });   
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
            $("#detailPanel").animate({
                left: 500
            }, 500);
        }
    );
}
