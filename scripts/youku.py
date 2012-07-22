# -*- coding: UTF-8 -*-
from function import *
    
def youkuSearch():
    print 'Searching youku now...'
    movies = []
    
    # available movies
    page = 1
    lastMovie = ''
    while True:
        print page, 
        html_src = getHtml('http://movie.youku.com/search/index2/_page63561_' + str(page) + '_cmodid_63561?ccat40486%5Bfe%5D=1&m40487%5Bcc-ms-q%5D=a%7Cpaid%3A0&__rt=1&__ro=m13382821540')
        html_src = unicode(html_src, 'utf-8')
        soup = BeautifulSoup(html_src)
        
        root = soup.find('div', {'class': 'collgrid6t'}).find('div', {'class': 'items'})
        items = root.findAll('ul', {'class': 'p pv'})
        
        # if movie is the same as the former one, this is the last page
        curMovie = items[0].find('li', {'class': 'p_title'}).find('a').string
        if curMovie == lastMovie:
            break
        lastMovie = curMovie
        
        length = len(items)
        for i in range(length):
            # ignore those not free
            if items[i].find('li', {'class': 'p_ischarge'}) != None:
                continue
            
            name = items[i].find('li', {'class': 'p_title'}).find('a').string
            url = items[i].find('li', {'class': 'p_link'}).find('a')['href']
            
            newMovie = {
                'name': name,
                'url': url
            }
            movies.append(newMovie)
            
        page += 1
        
    return movies
    
