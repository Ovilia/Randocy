# -*- coding: UTF-8 -*-
from function import *

def iqiyiSearch():
    print 'Searching iqiyi now...'
    movies = []
    
    # available movies
    page = 1
    while True:
        print page, 
        html_src = getHtml('http://list.iqiyi.com/www/1/----------0--2-1-' + str(page) + '-1---.html')
        html_src = unicode(html_src, 'utf-8')
        
        soup = BeautifulSoup(html_src)
        
        lis = soup.findAll('li', {'class': 'j-listanim'})
        if len(lis) < 1:
            break
        
        for i in range(len(lis)):
            a = lis[i].find('a', {'class': 'title'})
            name = a.string
            url = a['href']
            newMovie = {
                'name': name,
                'url': url
            }
            movies.append(newMovie)
        
        page += 1
    return movies
        