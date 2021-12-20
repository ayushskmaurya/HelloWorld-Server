# HelloWorld-Server
PHP and MySQL based Server for HelloWorld Messenger.

#### Instructions
1. Change `BASE_URL` as per your requirement in the `base.php` file.

2. Create a MySQL Database using the following command:
	```
	CREATE DATABASE helloworld;
	```

3. Create all the tables in this database using following command:
	```
	-- Users Table
	CREATE TABLE users (
		userid INT AUTO_INCREMENT,
		name VARCHAR(100) NOT NULL,
		mobile_no VARCHAR(10) UNIQUE NOT NULL,
		password VARCHAR(255) NOT NULL,
		profile_image VARCHAR(100) UNIQUE,
		PRIMARY KEY(userid)
	);
	```

	```
	-- Chats Table
	CREATE TABLE chats (
		chatid INT AUTO_INCREMENT,
		user1id INT NOT NULL,
		user2id INT NOT NULL,
		PRIMARY KEY(chatid),
		FOREIGN KEY (user1id) REFERENCES users(userid),
		FOREIGN KEY (user2id) REFERENCES users(userid)
	);
	```
	
	```
	-- Messages Table
	CREATE TABLE messages (
		msgid INT AUTO_INCREMENT,
		chatid INT NOT NULL,
		senderid INT NOT NULL,
		message TEXT,
		dateTime DATETIME(3) DEFAULT CURRENT_TIMESTAMP NOT NULL,
		isMsgSeen BOOLEAN DEFAULT false NOT NULL,
		PRIMARY KEY(msgid),
		FOREIGN KEY (chatid) REFERENCES chats(chatid),
		FOREIGN KEY (senderid) REFERENCES users(userid)
	);
	```

	```
	-- Attachments Table
	CREATE TABLE attachments (
		attachmentid INT AUTO_INCREMENT,
		msgid INT NOT NULL,
		filename VARCHAR(100) NOT NULL,
		temp_filename VARCHAR(100) NOT NULL,
		isFileUploaded BOOLEAN DEFAULT false NOT NULL,
		PRIMARY KEY(attachmentid),
		FOREIGN KEY (msgid) REFERENCES messages(msgid)
	);
	```
