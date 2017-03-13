#!/usr/bin/python
#by Flavio Kleiber
#fm cli

import createController;
# define the function blocks
def create_controller(args):
    createController.main(args)

# map the inputs to the function blocks
options = {'create controller' : create_controller,
}

print ("starting cli....")
exit = False

while(exit == False):
    args = input(">")

    if args == 'exit':
        print('bye bye')
        exit = True
    else:
        args = args.split()
        options[args[0]+' '+args[1]](args[2])
        #print(test)
