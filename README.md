## Real Estate v1

## Requirements
If you install your computer
```text
Docker version 20.10.8
docker-compose version 1.29.2
```

## Installations
First one
```text
git clone git@github.com:oguztopcu/real-estate.git
```

move to project directory
```text
cd /path/to/your/real-estate
docker-compose up -d
```

If you use without docker mysql, you should be change host
```text
HOST=host.docker.internal
```

and you should run on your terminal at project directory 

```text
php artisan key:generate
php artisan jwt:secret
php artisan migrate
```

Finally!

Go to your browser and open the link
```text
http://localhost:1337
```
