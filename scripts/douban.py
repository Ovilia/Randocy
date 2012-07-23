# -*- coding: UTF-8 -*-
from function import *
import time
    
def doubanSearch(movieName):
    html_src = getHtml("http://movie.douban.com/subject_search?search_text=" + movieName + "&cat=1002")
    soup = BeautifulSoup(html_src)
    
    div = soup.find('div', {'class': 'article'})
    
    # get most related movie
    try:
        tr = div.find('table').find('tr')
    except:
        # no movie found
        print movieName, "not found"
        return None
        
    td = tr.find('td')
    a = tr.find('a')
    url = a['href']
    doubanId = url[url.find('subject/') + len('subject/'): -1]
    name = a['title']
    imageUrl = a.findNext('img')['src']
    
    td = td.findNextSibling('td')
    span = td.find('a').find('span')
    if span == None:
        aliasName = ''
    else:
        aliasName = span.string
    
    p = td.find('p')
    span = p.findNext('span', {'class': 'rating_nums'})
    if span == None:
        # not enough score
        print movieName, "not enough score"
        return None
    
    score = span.string
    
    span = span.findNextSibling('span')
    scoreStr = span.string
    scoreAmt = 0
    for c in scoreStr:
        if c >= '0' and c <= '9':
            scoreAmt = scoreAmt * 10 + int(c)
    
    
    ### detail information ###
    html_src = getHtml(url, 'html5lib')
    soup = BeautifulSoup(html_src)
    
    # directors
    div = soup.find('div', {'id': 'info'})
    span = div.find('span')
    a = span.findAll('a')
    directors = ""
    if a != None:
        for i in a:
            directors += i.string + ' '
    directors = directors[:-1]
    
    # writers
    span = span.findNextSibling('span')
    a = span.findAll('a')
    writers = ""
    if a != None:
        for i in a:
            writers += i.string + ' '
    writers = writers[:-1]
    
    # actors
    span = span.findNextSibling('span')
    a = span.findAll('a')
    actors = ""
    if a != None:
        for i in a:
            actors += i.string + ' '
    actors = actors[:-1]
    
    # tags
    span = span.findNext('br').findNext('span')
    spans = span.findNextSiblings('span', {'property': 'v:genre'})
    tags = []
    if spans != None:
        for i in spans:
            tags.append(i.string)
    
    # release date
    date_span = span.findNext('span', {'property': 'v:initialReleaseDate'})
    if date_span == None:
        releaseDate = ''
    else:
        releaseDate = date_span['content']
    
    # run time
    span = span.findNext('span', {'property': 'v:runtime'})
    if span == None:
        runTime = ''
    else:
        runTime = span['content']
        
    # summary
    span = str(soup.find('span', {'property': 'v:summary'}))
    start = len('<span property="v:summary">')
    end = span.find('<span class')
    if end == -1:
        end = span.find('</span>')
    summary = span[start:end]
    
    movie = {
        'name': name,
        'doubanId': doubanId,
        'imageUrl': imageUrl,
        'aliasName': aliasName,
        'score': score,
        'scoreAmt': scoreAmt,
        
        'directors': directors,
        'writers': writers,
        'actors': actors,
        'tags': tags,
        'releaseDate': releaseDate,
        'runTime': runTime,
        'summary': summary
    }
    return movie

    
# return 'NULL' if field is None
# else return '"' + field + '"'
def wrapNone(field):
    if field == None:
        return "NULL"
    else:
        if type(field) != str:
            field = str(field)
        field = field.replace('"', "'")
        return '"' + field + '"'
    
def insertMovieSql(movie):
    return "INSERT IGNORE INTO `randocy`.`doubaninfo` (`doubanId`, `name`, `aliasName`, `imageUrl`, `score`, `scoreAmt`, `directors`, `writers`, `actors`, `releaseDate`, `runTime`, `summary`) VALUES (" + wrapNone(movie['doubanId']) + ", " + wrapNone(movie['name']) + ", " + wrapNone(movie['aliasName']) + ", " + wrapNone(movie['imageUrl']) + ", " + wrapNone(movie['score']) + ", " + wrapNone(movie['scoreAmt']) + ", " + wrapNone(movie['directors']) + ", " + wrapNone(movie['writers']) + ", " + wrapNone(movie['actors']) + ", " + wrapNone(movie['releaseDate']) + ", " + wrapNone(movie['runTime']) + ", " + wrapNone(movie['summary']) + ");\n"
    
def insertSiteSql(host, url, doubanId):
    return "INSERT IGNORE INTO `randocy`.`site` (`host`, `url`, `updateTime`, `DoubanInfo_doubanId`, `bugReport`) VALUES ('" + host + "', '" + url + "', CURRENT_TIMESTAMP, '" + doubanId + "', 0);\n"
    
