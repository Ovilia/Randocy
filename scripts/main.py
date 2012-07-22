# -*- coding: UTF-8 -*-
from function import *
from douban import *
from youku import *
from tudou import *

doubanId = []

sqlFile = open("insertMovie.sql", "w")

# youku
youku = youkuSearch()
start = False
for movie in youku:
    if movie['url'] == 'http://v.youku.com/v_show/id_XMzU3NTcwNTky.html':
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
        
            sqlFile.write(insertSiteSql("youku.com", movie['url'], doubanInfo['doubanId']))

sqlFile.close()
