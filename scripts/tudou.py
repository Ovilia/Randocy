# -*- coding: UTF-8 -*-
from function import *

def tudouSearch():
    print 'Searching tudou now...'
    movies = []
    
    # available movies
    page = 1
    lastMovie = ''
    while True:
        print page, 
        html_src = getHtml('http://movie.tudou.com/albumtop/c22t-1v-1z-1a-1y-1h-1s1p' + str(page) + '.html')
        html_src = unicode(html_src, 'gbk')
        
        soup = BeautifulSoup(html_src)
        
        divs = soup.findAll('div', {'class': 'pack pack_album'})
        curMovie = divs[0].find('h6', {'class': 'caption'}).find('a').string
        if lastMovie == curMovie:
            break
        lastMovie = curMovie
        
        for i in range(len(divs)):
            a = divs[i].find('h6', {'class': 'caption'}).find('a')
            name = a.string
            url = a['href']
            
            newMovie = {
                'name': name,
                'url': url
            }
            movies.append(newMovie)
            
        page += 1
        
    return movies
        