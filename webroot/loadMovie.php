<?php
    include('function.php');
    
    function getBriefHtml($movies) {
        $cnt = count($movies);
        $index = 0;
        do {
?>
            <div class="movie" id="movie<?php echo $movies[$index]['doubanId']; ?>" 
                onclick="showDetail(<?php echo $movies[$index]['doubanId']; ?>)">
                <div class="movieImg">
                    <img alt="<?php echo $movies[$index]['name']; ?>" 
                        src="<?php echo $movies[$index]['imageUrl']; ?>" />
                </div>
                <div class="movieName ellipsisLine" title="<?php echo $movies[$index]['name']; ?>">
                    <?php echo $movies[$index]['name']; ?>
                </div>
                <div class="movieDouban">
                    <a target="_blank" href="http://movie.douban.com/subject/<?php echo $movies[$index]['doubanId']; ?>/">
                        <img alt="豆瓣评分" src="image/douban.png" class="doubanImg" />
                    </a>
                    <span class="doubanScore"><?php echo $movies[$index]['score']; ?></span>
                </div>
                <div class="moviePlay">
                    <?php
                        $playCnt = count($movies[$index]['site']);
                        $playIndex = 0;
                        do {
                    ?>
                    <a target="_blank" href="<?php echo $movies[$index]['site'][$playIndex]['url']; ?>">
                        <img src="image/<?php echo $movies[$index]['site'][$playIndex]['host']; ?>.png"
                            alt="<?php echo $movies[$index]['site'][$playIndex]['host']; ?>" />
                    </a>
                    <?php
                            $playIndex += 1;
                        } while ($playIndex < $playCnt);
                    ?>
                </div>
                <div class="operation">
                    <a href="#" title="这个可播放的电影和豆瓣信息不符合啊！╮(╯▽╰)╭"
                        onclick="hideMovie('<?php echo $movies[$index]['site'][0]['url']; ?>', 'movie<?php echo $movies[$index]['doubanId']; ?>')">报错</a>
                    <a href="#">收藏</a>
                    <a href="#" title="不要再显示这个电影啦，我看过了或者不想看"
                        onclick="$('#movie<?php echo $movies[$index]['doubanId']; ?>').fadeOut()">忽略</a>
                </div>
            </div>
    <?php
            $index += 1;
        } while ($index < $cnt);
    }
    
    if (isset($_GET['isBrief'], $_GET['start'], $_GET['count']) 
            and $_GET['isBrief'] == 'true') {
        echo getBriefHtml(getMovieBrief($_GET['start'], $_GET['count']));
        
    } else if (isset($_GET['isBrief'], $_GET['doubanId']) 
            and $_GET['isBrief'] == 'false') {
        echo getMovieDetail($_GET['doubanId']);
    }
    
?>
