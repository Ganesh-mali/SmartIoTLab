# Import Minio library.
from minio import Minio
from minio.error import (ResponseError, BucketAlreadyOwnedByYou,
                         BucketAlreadyExists)

# Initialize minioClient with an endpoint and access/secret keys.
minioClient = Minio('172.18.22.9:9000',
                    access_key='AKIAIOSFODNN734dfhdfh',
                    secret_key='sdfjk335jlkAefldkfjs8s7989sd',
                    secure=False)
objects=minioClient.list_objects('iotlab3', prefix=None, recursive=False) 
count = 0;
for obj in objects:
    count+=1
    print(obj.bucket_name, obj.object_name.encode('utf-8'), obj.last_modified,
          obj.etag, obj.size, obj.content_type)
print("Total number of objects in this bucket is "+str(count))