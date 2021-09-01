# HelloWorld-Server
PHP and MySQL based Server for HelloWorld Messenger.

#### Instructions
1. Change `BASE_URL` as per your requirement in the `base.php` file.

2. Create a MySQL Database using the following command:
	```
	CREATE DATABASE helloworld;
	```

3. Create the Users table in this database using following command:
	```
	CREATE TABLE users (
		userid INT AUTO_INCREMENT,
		name VARCHAR(100) NOT NULL,
		mobile_no VARCHAR(10) UNIQUE NOT NULL,
		password VARCHAR(255) NOT NULL,
		PRIMARY KEY(userid)
	);
	```
