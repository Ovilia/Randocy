# -*- coding: UTF-8 -*-
import urllib, urllib2, cookielib, re, string, html5lib, json, codecs
from bs4 import BeautifulSoup

import sys
default_encoding = 'utf-8'
if sys.getdefaultencoding() != default_encoding:
    print 'Change encoding now...'
    reload(sys)
    sys.setdefaultencoding(default_encoding)

myCookie = urllib2.HTTPCookieProcessor(cookielib.CookieJar())
opener = urllib2.build_opener(myCookie)
opener.addheaders = [('User-agent', 'Mozilla/5.0')]

def postHtml(url, post_data, referer = None):
    req = urllib2.Request(url, urllib.urlencode(post_data))
    if referer != None:
        req.add_header('Referer', referer)
    
    try:
        html_src = opener.open(req).read()
        return html_src

    except urllib2.HTTPError, e:
        print "HTTPError = " + str(e.code)
    except urllib2.URLError, e:
        print "URLError = " + str(e.reason)
    except Exception:
        import traceback
        print "generic exception:" + traceback.format_exc()
        
def getHtml(url, referer = None):
    req = urllib2.Request(url)
    if referer != None:
        req.add_header('Referer', referer)
    html_src = opener.open(req).read()
    return html_src
    
def saveTmp(src):
    file = open('tmp.html', 'w')
    file.write(src)
    file.close()