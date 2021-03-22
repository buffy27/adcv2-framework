import sys
import json
import re
import os
import requests
from bs4 import BeautifulSoup
def div_split(text):
    result = re.search('>;(.*)<', text)
    return result
config = {
    "title" : "",
    "title_jp" : "",
    "synopsis" : "",
    "type" : "",
    "year" : "",
    "directors" : "",
    "url" : "",
    "episodes" : "",
    "studios" : "",
    "genres" : "",
    "duration" : "",
}
if len(sys.argv) != 2:
    print(json.dumps({"error":"AniDB link empty"}))
    quit(0);
headers = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36'}
#https://myanimelist.net/anime/41353/The_God_of_High_School
id = sys.argv[1]
url = requests.get("https://myanimelist.net/anime/" + id, headers=headers)
soup = BeautifulSoup(url.content, 'html.parser')
#clean synopsys
config.update(synopsis = soup.find("p", {"itemprop":"description"}).text)

genres = soup.find_all("span", {"itemprop":"genre"})
out_genres = "Genres: "
for i in range(len(genres)):
    if(i < len(genres)-1):
        out_genres +=  genres[i].text + ", "
    else:
        out_genres += genres[i].text
config.update(genres = out_genres)

x = soup.find("td", {"class": "borderClass"}).find_all("div")
for y in x:
    y = y.text
    y = y.replace("\n", " ")
    if (y.find("Synonyms:") == 1):
        config.update(title = y)
    if(y.find("Japanese:") == 1):
        config.update(title_jp=y)
    if(y.find("Type:") == 1):
        config.update(type = y)
    if (y.find("Episodes:") == 1):
        config.update(episodes=y)
    if (y.find("Aired:") == 1):
        config.update(year=y)
    if (y.find("Studios:") == 1):
        config.update(studios=y)
    if (y.find("Duration:") == 1):
        config.update(duration=y)

image_url = soup.find("div", {"style":"text-align: center;"}).find('img')['data-src']
ext = image_url.rfind(".")
image_ext = image_url[ext:]
image_url = image_url[:ext] + "l" + image_ext

config.update(url = image_url)

print(json.dumps(config))