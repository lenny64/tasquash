#!/usr/bin/env python
#-*-coding: utf-8-*-

import sys
import json
import requests

def main():
    s = "query"
    res = requests.post("http://51.83.44.173/api/enlecs2/", data=s)
    if str(res) == '<Response [500]>':
        print("Server Error")
    else:
        print(res.json())

main()
