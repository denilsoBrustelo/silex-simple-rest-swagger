# Silex Simple REST with its auto generated documentation with Swagger 

[![Dependency Status](https://www.versioneye.com/user/projects/538b2ece14c158f14b000011/badge.png)](https://www.versioneye.com/user/projects/538b2ece14c158f14b000011)


A simple silex skeleton application for writing RESTful API. 
Based on the silex-simple-rest github repo from  [Alessandro Arnodo](http://alessandro.arnodo.net).
silex-simple-rest-swagger is a fork, which add a swagger REST API Documentation, auto generated.

**This project wants to be a starting point to writing scalable and maintainable REST api with Silex PHP micro-framework**

Continuous Integration is provided by [Travis-CI](http://travis-ci.org/).

####How do I run it?
From this folder run the following commands to install the php and bower dependencies, import some data, and run a local php server.

You need at least php **5.4.*** with **SQLite extension** enabled and **Composer**
    
    composer install 
    sqlite3 app.db < resources/sql/schema.sql
    php -S 0:9001 -t web/

You can install the project also as a composer project
		
		composer create-project vjeantet/silex-simple-rest-swagger
    
Your api is now available at [http://localhost:9001/api/v1](http://localhost:9001/api/v1).

You api documentation is now available as a swagger specification at [http://localhost:9001/api/api-docs](http://localhost:9001/api/api-docs).

You can visualise your api documentation going to : [http://petstore.swagger.wordnik.com/](http://petstore.swagger.wordnik.com/) and typing your local api swagger spec url : http://localhost:9001/api/api-docs.

  

####Run tests
Some tests were written, and all CRUD operations are fully tested :)

From the root folder run the following command to run tests.
    
    vendor/bin/phpunit 


####What you will get
The api will respond to

	GET  ->   http://localhost:9001/api/v1/notes
	POST ->   http://localhost:9001/api/v1/notes
	POST ->   http://localhost:9001/api/v1/notes/{id}
	DELETE -> http://localhost:9001/api/v1/notes/{id}

Your request should have 'Content-Type: application/json' header.
Your api is CORS compliant out of the box, so it's capable of cross-domain communication.

Try with curl:
	
	#GET
	curl http://localhost:9001/api/v1/notes -H 'Content-Type: application/json' -w "\n"

	#POST (insert)
	curl -X POST http://localhost:9001/api/v1/notes -d '{"note":"Hello World!"}' -H 'Content-Type: application/json' -w "\n"

	#POST (update)
	curl -X POST http://localhost:9001/api/v1/notes/1 -d '{"note":"Uhauuuuuuu!"}' -H 'Content-Type: application/json' -w "\n"

	#DELETE
	curl -X DELETE http://localhost:9001/api/v1/notes/1 -H 'Content-Type: application/json' -w "\n"

####What's under the hood
Take a look at the source code, it's self explanatory :)
More documentation and info about the code will be available soon.

Under the resources folder you can find a .htaccess file to put the api in production.

####Contributing

Fell free to contribute, fork, pull request, hack. Thanks!

####Author

+   [@vjeantet](https://twitter.com/vjeantet)

+	[@vesparny](https://twitter.com/vesparny)


## License

see LICENSE file.






