# An exercise about a REST API for submitting long-running jobs

You need Docker, PHP 8, composer and [symfony](https://symfony.com/doc/current/setup.html) to run this example.

To prepare your environment you have to run these commands:
```
docker compose up -d
compose install
```

Now you should be able to run tests:
```
php bin/phpunit
```

To see the application running:
```
symfony server:start
```

Then, in order to add a long-running task:
```
curl -X POST http://localhost:8000/api/long_job/add --data '{"data": "hello"}'
```

You should get an answer like this:
```
{"id":"29498630-e1cd-42aa-9860-b89dd4295955"}
```

You can use this id to query the status of the job:
```
curl -X GET  http://localhost:8000/api/long_job/29498630-e1cd-42aa-9860-b89dd4295955 
```

This call should respond with something like this:
```
{"id":"29498630-e1cd-42aa-9860-b89dd4295955","status":"started","startedOn":"2022-06-30T13:15:10+00:00","endedAt":null,"finalData":null}
```