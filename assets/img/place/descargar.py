import urllib

temp=(
 "http://landsat.usgs.gov/images/gallery/12_M.jpg","http://landsat.usgs.gov/images/gallery/11_M.jpg","http://landsat.usgs.gov/images/gallery/10_M.jpg","http://landsat.usgs.gov/images/gallery/9_M.jpg","http://landsat.usgs.gov/images/gallery/8_M.jpg","http://landsat.usgs.gov/images/gallery/7_M.jpg","http://landsat.usgs.gov/images/gallery/6_M.jpg","http://landsat.usgs.gov/images/gallery/5_M.jpg","http://landsat.usgs.gov/images/gallery/4_M.jpg","http://landsat.usgs.gov/images/gallery/3_M.jpg","http://landsat.usgs.gov/images/gallery/2_M.jpg","http://landsat.usgs.gov/images/gallery/1_M.jpg")

for x in temp:
    print x[39:]
    urllib.urlretrieve(x,x[39:])
