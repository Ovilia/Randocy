<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>燃豆萁 - 在线播放豆瓣高分电影</title>
    
    <link rel='stylesheet' type='text/css' href='css/common.css' >
    <script src='js/jquery.js'></script>
    <script src='js/randocy.js'></script>
    
    <?php 
        include('function.php');
        $movies = getMovieBrief(0, 30);
    ?>
</head>
<body>
    <div id="content">
        <div id="title">
            <img alt="燃豆萁 - 在线播放豆瓣高分电影" src="image/title.png" />
            <hr />
        </div>
        <div id="moviePanel">
            <?php
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
                    <a href="#" onclick="hideMovie('<?php echo $movies[$index]['site'][0]['url']; ?>', 'movie<?php echo $movies[$index]['doubanId']; ?>')">报错</a>
                    <a href="#">收藏</a>
                    <a href="#">忽略</a>
                </div>
            </div>
            <?php
                    $index += 1;
                } while ($index < $cnt);
            ?>
        </div>
    </div>
    <div id="detailPanel">
    </div>
</body>
</html>