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

#print(ayer())


#def anteayer():
#        today=datetime.date.today()
#        oneday=datetime.timedelta(days=2)
#        yesterday=today-oneday
#        return yesterday
#print(anteayer())


uno=ayer()
hoy=datetime.date.today()
#dos=ayer()

print(hoy)
print(uno)


result=commands.getoutput("aws ce get-cost-and-usage --time-period Start="+str(uno)+",End="+str(hoy)+" --granularity DAILY --metrics AmortizedCost --profile LaterceraV2")
datos=json.dumps(result)
decoded=json.loads(result)
#print(str(decoded["ResultsByTime"][0]["TimePeriod"]["Start"]))
valor=(float(decoded["ResultsByTime"][0]["Total"]["AmortizedCost"]["Amount"]))
print(valor)

##Codigo para obteber Query de Charbeat OK
#url="http://api.chartbeat.com/query/v2/submit/page/?host=latercera.com&apikey=8d3b6be7f81de853383bce3fd3ac7796&start=2019-02-23&end=2019-02-24&tz=America/Santiago&metrics=page_views_loyal"
url="http://api.chartbeat.com/query/v2/submit/page/?host=latercera.com&apikey=8d3b6be7f81de853383bce3fd3ac7796&start="+str(uno)+"&end="+str(uno)+"&tz=America/Santiago&metrics=page_views_loyal"
urlvistas="http://api.chartbeat.com/query/v2/submit/page/?host=latercera.com&apikey=8d3b6be7f81de853383bce3fd3ac7796&start="+str(uno)+"&end="+str(uno)+"&tz=America/Santiago&metrics=page_views"
paginaWebATexto(url)


#datos2='{"query_id": "aba4a4a0-a6c7-49c7-a19a-c87734d319db"}'
decoded=json.loads(paginaWebATexto(url))
query=(decoded["query_id"])
url2="http://api.chartbeat.com/query/v2/fetch/?host=latercera.com&apikey=8d3b6be7f81de853383bce3fd3ac7796&query_id="+query
print(url2)

time.sleep(10)

# Descarga Archivo CVS y guarda en Disco

import requests, csv

download = requests.get(url2)
with open('download.csv', 'w') as temp_file:
    temp_file.writelines(download.content)

output=commands.getoutput('awk NR==2 download.csv')
print(output)


decoded=json.loads(paginaWebATexto(urlvistas))
query=(decoded["query_id"])
url3="http://api.chartbeat.com/query/v2/fetch/?host=latercera.com&apikey=8d3b6be7f81de853383bce3fd3ac7796&query_id="+query
print(url3)

time.sleep(10)

download = requests.get(url3)
with open('download2.csv', 'w') as temp_file:
    temp_file.writelines(download.content)

output2=commands.getoutput('awk NR==2 download2.csv')
print(output2)



result2=commands.getoutput("aws ce get-cost-and-usage --time-period Start="+str(uno)+",End="+str(hoy)+" --granularity DAILY --metrics AmortizedCost --profile LaterceraV2 --group-by Type=DIMENSION,Key=SERVICE --filter file://filtro.json")
datos=json.dumps(result2)
decoded2=json.loads(result2)
cloudfront=(float(decoded2["ResultsByTime"][0]["Groups"][0]["Metrics"]["AmortizedCost"]["Amount"]))
print(cloudfront)
elasticache=(float(decoded2["ResultsByTime"][0]["Groups"][1]["Metrics"]["AmortizedCost"]["Amount"]))
print(elasticache)
ec2=(float(decoded2["ResultsByTime"][0]["Groups"][2]["Metrics"]["AmortizedCost"]["Amount"]))
print(ec2)
rds=(float(decoded2["ResultsByTime"][0]["Groups"][3]["Metrics"]["AmortizedCost"]["Amount"]))
print(rds)






#Codigo Ingresar Datos a Base de Datos
mariadb_connection = mariadb.connect(user='copesa', password='C0CBW4xKv6', database='costos')
cursor = mariadb_connection.cursor()
try:
   cursor.execute("insert into costos.diario(id_cuenta, costo, fecha,visitas, page_views, cloudfront, elasticache, rds, ec2) values((select id_cuenta from costos.cuenta where nombre='latercerav2'), round(%s,2),%s,%s,%s,round(%s,2),round(%s,2),round(%s,2),round(%s,2))", (valor,uno,int(output),int(output2),cloudfront,elasticache,rds,ec2))
except mariadb.Error as error:
   print("Error: {}".format(error))

mariadb_connection.commit()
mariadb_connection.close()



#def getYesterday(): 
#	today=datetime.date.today() 
#	oneday=datetime.timedelta(days=1) 
#	yesterday=today-oneday  
#	return yesterday
#
#
#print(getYesterday())
