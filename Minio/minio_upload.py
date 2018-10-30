# Import Minio library.
from minio import Minio
from minio.error import (ResponseError, BucketAlreadyOwnedByYou,
                         BucketAlreadyExists)

# Initialize minioClient with an endpoint and access/secret keys.
minioClient = Minio('172.18.22.9:9000',
                    access_key='AKIAIOSFODNN734dfhdfh',
                    secret_key='sdfjk335jlkAefldkfjs8s7989sd',
                    secure=False)

# Make a bucket with the make_bucket API call.
#Once we create the bucket we should not call create bucket function again
'''
try:
       minioClient.make_bucket("vlogs", location="us-east-1")
except BucketAlreadyOwnedByYou as err:
       pass
except BucketAlreadyExists as err:
       pass
except ResponseError as err:
       raise
else:
        # Put an object 'pumaserver_debug.log' with contents from 'pumaserver_debug.log'.
'''
try:
       minioClient.fput_object('vlogs', 'temp.txt', '/home/vikas/temp.txt')
#list_objects(vlogs, prefix=None, recursive=False) 
except ResponseError as err:
       print(err)

