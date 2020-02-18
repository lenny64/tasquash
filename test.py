#!/usr/bin/env python
#-*-coding: utf-8-*-

import sys
import json

def main():
    category = 150
    probabiliy = 0.653785
    response = {"status":200, "message":"Everything is fine.", "data":{"category": category, "probabiliy": probabiliy}}
    print json.dumps(response)

main()
