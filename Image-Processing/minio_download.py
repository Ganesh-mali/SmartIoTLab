# -*- coding: utf-8 -*-
#This program is used to download objects from minio object server having address 172.18.22.9:3000

from minio import Minio
from minio.error import ResponseError

minioClient = Minio('172.18.22.9',
                  access_key='AKIAIOSFODNN734dfhdfh',
                  secret_key='sdfjk335jlkAefldkfjs8s7989sd',
                  secure=False)


try:
    data = minioClient.get_object('iotlab', 'myobject')
    with open('my-testfile', 'wb') as file_data:
        for d in data.stream(32*1024):
            file_data.write(d)
except ResponseError as err:
    print(err)

