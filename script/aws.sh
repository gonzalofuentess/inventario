#!/bin/bash
script='Reservations[*].Instances[*].{TipoDeInstancia:InstanceType,Tags:Tags[0].Value,PublicDnsName:PublicDnsName,PublicIpAddress:PublicIpAddress,IdInstancia:InstanceId,Nombre:KeyName,Estado:State.Name}'
#Cuenta dada de baja
aws ec2 describe-instances --profile aws-avisoslegales --query $script > /usr/share/nginx/html/inventario/aws/aws-avisoslegales
