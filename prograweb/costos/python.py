import datetime
import commands
import time
import json
#import MySQLdb
import mysql.connector as mariadb


#datos = [localhost, copesa, ]

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



mariadb_connection = mariadb.connect(user='copesa', password='C0CBW4xKv6', database='costos')
cursor = mariadb_connection.cursor()
try:
   cursor.execute("insert into costos.diario(id_cuenta, costo, fecha) values((select id_cuenta from costos.cuenta where nombre='latercerav2'), round(%s,2),%s)", (valor,uno))
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
