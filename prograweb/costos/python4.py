#import os
import commands
import requests
import sys
import datetime
import commands
import time
import urllib2
import json
import time
#import MySQLdb
import mysql.connector as mariadb
#import urllib2.request
#from io import StringIO


#datos = [localhost, copesa, ]


def download(url):
    """Returns the HTML source code from the given URL
        :param url: URL to get the source from.
    """
    r = requests.get(url)
    if r.status_code != 200:
        sys.stderr.write("! Error {} retrieving url {}".format(r.status_code, url))
        return None
    print(r)
    #return r.text




def paginaWebATexto(url):
    import urllib2
    respuesta = urllib2.urlopen(url)
    html = respuesta.read()
    #print(html)
    #texto = quitarEtiquetas(html).lower()
    return html


def ayer(): 
	today=datetime.date.today() 
	oneday=datetime.timedelta(days=1) 
	yesterday=today-oneday  
	return yesterday


uno=ayer()
hoy=datetime.date.today()
#dos=ayer()

print(hoy)
print(uno)

# result=commands.getoutput("aws ce get-cost-and-usage --time-period Start="+str(uno)+",End="+str(hoy)+" --granularity DAILY --metrics AmortizedCost --profile LaterceraV2")
#datos=json.dumps(result)
#decoded=json.loads(result)
#print(str(decoded["ResultsByTime"][0]["TimePeriod"]["Start"]))
#valor=(float(decoded["ResultsByTime"][0]["Total"]["AmortizedCost"]["Amount"]))




result=commands.getoutput("aws ce get-cost-and-usage --time-period Start="+str(uno)+",End="+str(hoy)+" --granularity DAILY --metrics AmortizedCost --profile LaterceraV2 --group-by Type=DIMENSION,Key=SERVICE --filter file://filtro.json")
datos=json.dumps(result)
decoded=json.loads(result)
cloudfront=(float(decoded["ResultsByTime"][0]["Groups"][0]["Metrics"]["AmortizedCost"]["Amount"]))
print(cloudfront)
elasticache=(float(decoded["ResultsByTime"][0]["Groups"][1]["Metrics"]["AmortizedCost"]["Amount"]))
print(elasticache)
ec2=(float(decoded["ResultsByTime"][0]["Groups"][2]["Metrics"]["AmortizedCost"]["Amount"]))
print(ec2)
rds=(float(decoded["ResultsByTime"][0]["Groups"][3]["Metrics"]["AmortizedCost"]["Amount"]))
print(rds)


