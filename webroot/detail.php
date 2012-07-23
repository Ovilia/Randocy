<?php
    include('function.php');
    $movie = getMovieDetail($_GET['doubanId']);
?>

<div id="detailTitle">
    <h3><?php echo $movie['name']; ?></h3>
</div>
<div id="detailImg">
    <img alt="<?php echo $movie['name']; ?>" src="<?php echo $movie['imageUrl']; ?>" />
</div>
<div id="detailRight">
    <div class="movieDouban">
        <a href="http://movie.douban.com/subject/<?php echo $movie['doubanId']; ?>/">
            <img alt="豆瓣评分" src="image/douban.png" class="doubanImg" />
        </a>
        <span class="doubanScore"><?php echo $movie['score']; ?></span>
        <span class="doubanScoreAmt">（<?php echo $movie['scoreAmt']; ?>人评价）</span>
    </div>
    
    <span>上映日期：</span>
    <label id="releaseDate"><?php echo $movie['releaseDate']; ?></label>
    <br />
    
    <span>片长：</span>
    <label id="runTime"><?php echo $movie['runTime']; ?>分钟</label>
    <br /><br />
    
</div>
<div id="detailDown">
    <span>主演：</span>
    <label id="actors"><?php echo $movie['actors']; ?></label>
    <br />
    <span>导演：</span>
    <label id="directors"><?php echo $movie['directors']; ?></label>
    <br />
    <span>编剧：</span>
    <label id="writers"><?php echo $movie['writers']; ?></label>
    <br /><br />
    
    <span>简介：</span>
    <label id="summaryLabel"><?php echo $movie['summary']; ?></label>
</div>