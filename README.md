# Lumen 8 service

Use the docker to run the service

Download the repo. 

I included .env file on the repo.
Change the DB connection, I use mongodb from MongoDB Atlas cause its free. 

Update variable on env

```bash
MONGODB_DSN=
```

Build the service
```bash
docker-compose up --build
```

Migration and seeding will automatically run.

Postman Collection
```bash
https://www.getpostman.com/collections/8edd26b7d37b718e724d
```




