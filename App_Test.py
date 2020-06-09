#!/usr/bin/env python
#-*-coding:utf-8-*-

import requests
import json
from tkinter import *


def process(query):
    s = json.dumps(query)
    res = requests.post("http://51.83.44.173/api/enlecs2/", json=s)
    if str(res) == '<Response [500]>':
        return "Server Error"
    else:
        return eval(res.json())


def main():

    root = Tk()
    topframe = Frame(root)
    topframe.pack()
    bottomframe = Frame(root)
    bottomframe.pack()

    def new_bottomframe():
        bottomframe = Frame(root)
        bottomframe.pack()

    def retrieve_input():
        def list2print(enlecs_result):
            category_listing = []
            for item in enlecs_result:
                try:
                    for key, value in item.items():
                        category_listing.append(("➤" + str(key) + "➤"))
                        for category in value:
                            category_listing.append(("           ➤" + str(category) + "⦿"))
                except AttributeError:
                    category_listing.append(("➤" + item + "⦿"))

            return category_listing


        global results
        for child in bottomframe.winfo_children():
            child.destroy()
        new_bottomframe()
        query = text_box.get("1.0", "end-1c")
        results = process(query)
        print_categories(list2print(results))

    def print_categories(results):
        for category in results:
            label_categories = Label(bottomframe, text=category, fg='black', anchor="w")
            label_categories.pack(fill='both')

    label_3 = Label(topframe, text="ENLECS 2.0                       Vers.20200227_2108")
    label_3.pack(fill=X)

    label_1 = Label(topframe, text="Please enter your query: ")
    label_1.pack(fill=X)

    root.geometry("600x600")
    text_box = Text(topframe, height=5, width=60)
    text_box.pack(fill=X)

    button_1 = Button(topframe, text='Submit', command=lambda: retrieve_input())
    button_1.pack(fill=X)

    label_4 = Label(topframe, text="")
    label_4.pack(fill=X)

    root.mainloop()


if __name__ == "__main__":
    main()
