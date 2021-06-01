import colorama
from colorama import Fore, Style, Back
import requests
import os
import sys
import time

colorama.init(autoreset=True)

updatefile = os.path.isfile('<yourexename>.exe')
if(updatefile == True):
    os.remove("<yourexename>.exe")

updatefile = os.path.isfile('<yourexename>.exe')
if(updatefile == False):
    if sys.platform == "win32":
        print(f""" {Fore.YELLOW}

                                                  ______________  ______
                                                 / ____/  _/ __ \/ ____/
                                                / /_   / // /_/ / __/   
                                               / __/ _/ // _, _/ /___   
                                              /_/   /___/_/ |_/_____/ 
                                                                        

        """+Fore.RESET)
        print(f"{Fore.GREEN}[Updater] Downloading new Fire Verison.")
        open("./<yourexename>.exe", "wb").write(requests.get("https://<yourdomain>/<yourexename>.exe", allow_redirects=True).content)
        os.system("start <yourexename>.exe")
        os.system("cls")
        print(f""" {Fore.YELLOW}

                                                  ______________  ______
                                                 / ____/  _/ __ \/ ____/
                                                / /_   / // /_/ / __/   
                                               / __/ _/ // _, _/ /___   
                                              /_/   /___/_/ |_/_____/ 
                                                                        

        """+Fore.RESET)
        print(f"{Fore.GREEN}[Updater] New Fire Version sccessfully installed")
        time.sleep(5)
        os._exit(0)