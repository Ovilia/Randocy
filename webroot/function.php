<?php
function connectDb() {
    $link = mysql_connect(SAE_MYSQL_HOST_M . ":" .  SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS) 
        or die("Could not connect");
    mysql_select_db(SAE_MYSQL_DB) or die("Could not select database");
    mysql_query("SET NAMES 'utf8'", $link);
    return $link;
}

function getMovieBrief($start, $count) {
    $link = connectDb();
    $query = "SELECT doubanId, name, imageUrl, score FROM `doubaninfo` WHERE doubanId IN " .
        "(SELECT DoubanInfo_doubanId FROM `site` WHERE `bugReport` < 50) " .
        "ORDER BY score DESC , scoreAmt DESC LIMIT " . $start . " , " . $count;
    $result = mysql_query($query) or die("Query failed"); 
    
    $movies = array();
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $subQuery = "SELECT host, url FROM site WHERE DoubanInfo_doubanId = " . $line['doubanId'];
        $subResult = mysql_query($subQuery) or die("Query failed"); 
        
        $site = array();
        while ($subLine = mysql_fetch_array($subResult, MYSQL_ASSOC)) {
            array_push($site, $subLine);
        }
        mysql_free_result($subResult);
        $line['site'] = $site;
        
        array_push($movies, $line);
    }
    
    mysql_free_result($result);
    mysql_close($link);
    
    return $movies;
}

function getMovieDetail($doubanId) {
    $link = connectDb();
    $query = "SELECT * FROM `doubaninfo` WHERE doubanId = " . $doubanId . " LIMIT 1";
    $result = mysql_query($query) or die("Query failed"); 
    
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
    mysql_free_result($result);
    mysql_close($link);
    
    return $line;
}

function hideMovie($url) {
    $link = connectDb();
    $query = "SELECT bugReport FROM `site` WHERE `url` = '" . $url . "' LIMIT 1";
    $result = mysql_query($query) or die("Query failed");
    $line = mysql_fetch_array($result, MYSQL_ASSOC);
    $cnt = $line['bugReport'];
    mysql_free_result($result);
    
    $query = "UPDATE `site` SET `bugReport` = " . ($cnt + 1) . " WHERE url = '" . $url . "'";
    mysql_query($query) or die("Query failed"); 
    
    mysql_close($link);
}

?>
