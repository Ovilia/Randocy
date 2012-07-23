# -*- coding: UTF-8 -*-
from function import *
from douban import *
from youku import *
from tudou import *
from iqiyi import *

def main():
    doubanId = []

    sqlFile = open("iqiyiMovie1.sql", "w")

    # youku
    #youku = youkuSearch()
    
    # tudou
    #tudou = tudouSearch()
    
    # iqiyi
    iqiyi = iqiyiSearch()
    
    start = False
    for movie in iqiyi:
        if movie['url'] == 'http://www.iqiyi.com/dianying/20110421/a37b9766a2fc7d7e.html':
            start = True
            continue
        if start == False:
            continue
            
        print movie['name'], 
        doubanInfo = doubanSearch(movie['name'])
        if doubanInfo != None:
            if doubanInfo['doubanId'] not in doubanId:
                sqlFile.write(insertMovieSql(doubanInfo))
                doubanId.append(doubanInfo['doubanId'])
            
                sqlFile.write(insertSiteSql("iqiyi.com", movie['url'], doubanInfo['doubanId']))

    sqlFile.close()

main()
