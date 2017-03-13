#!/usr/bin/python

#by Flavio Kleiber
#fm cli
import os
from subprocess import call

def main(controllerName):
    print ('starting....')
    fn = '../application/controllers/'+controllerName+'Controller.php'
    directory = '../application/view/' + controllerName.lower()
    if not os.path.exists(directory):
        os.makedirs(directory)
    print ('View dirs created....')
    try:
        file = open(fn, 'r')
    except IOError:
        file = open(fn, 'w')

    file.write("<?php \n //generate by fm-cli \n class "+controllerName+'Controller'+" extends BaseController {\n\n\tpublic function indexAction(){\n\t }\n\n}");
    print("file created")
    print("register controller!")
    call(["composer", 'dumpautoload -o'])
    print ('finished!....')
