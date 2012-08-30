<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>燃豆萁 - 在线播放豆瓣高分电影</title>
    
    <link rel='stylesheet' type='text/css' href='css/common.css' >
    <link rel='stylesheet' type='text/css' href='css/jquery-ui.css' >
    
    <script src='js/jquery.js' type="text/javascript"></script>
    <script src='js/jquery-ui.js' type="text/javascript"></script>
    <script src='js/randocy.js' type="text/javascript"></script>
</head>
<body>
    <a href="https://github.com/Ovilia/Randocy" target="_blank">
        <img style="position: absolute; top: 0; right: 0; border: 0;" src="image/forkme.png" alt="Fork me on GitHub" />
    </a>
    <div id="content">
        <div id="title">
            <img alt="燃豆萁 - 在线播放豆瓣高分电影" src="image/title.png" />
        </div>
        
        <div id="nav">
            <!--button class="ui-state-highlight">电影</button-->
            <div id="navRadio">
                <input type="radio" id="movieRadio" name="navRadio" checked="checked" />
                <label for="movieRadio">电影</label>
                
                <input type="radio" id="authorRadio" name="navRadio" />
                <label for="authorRadio">作者</label>
            </div>
        </div>
        
        <hr />
        <div id="moviePanel">
        </div>
        
        <div id="authorPanel">
            <img src="image/author.png" id="authorImg" />

            <div id="douban">
                <a href="http://www.douban.com/people/16920492/" target="_blank">
                    <img src="image/doubanTxt.png" id="doubanImg" alt="豆瓣"/>
                </a>
                <script type="text/javascript" src="http://www.douban.com/service/badge/16920492/?show=collection&amp;select=random&amp;n=20&amp;columns=4&amp;hidelogo=yes&amp;hideself=yes" ></script>
            </div>

            <div id="weibo">
                <a href="http://weibo.com/plainjane" target="_blank">
                    <img src="image/sinaTxt.png" id="weiboImg" alt="新浪微博" />
                </a>
                <iframe width="300" height="534" class="share_self"  frameborder="0" scrolling="no" src="http://ishow.sinaapp.com/show.php?width=300&height=534&fansRow=2&ptype=1&speed=0&skin=10&isTitle=1&noborder=1&isWeibo=1&isFans=1&uid=1615383502&verifier=7c978b56&sign=&t=sina&s=1615383502&q=" id="weiboShow"></iframe>
            </div>
        </div>
    </div>
    <div id="detailPanel">
    </div>
</body>
</html>
