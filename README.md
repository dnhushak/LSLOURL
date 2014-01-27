#Short Link

Short link is a short url geneartor with stats tracking.

It associates a short, easy to remember url, called a _slug_, with a longer, more error prone, and often uglier url.

For example, 
```
http://www.example.com/google
```
could forward to 
```
http://www.google.com/search?q=does+anybody+actually+read+readme+files%3F
```

Short link uses the features of .htaccess to force every requested url to redirect to index.php with a $_GET[] variable in the url. Index.php will then gather information about the user (ip address, browser, etc), and log each url hit in a database.

This version uses a MySQL database to manage both the url forwarding associations and the hit counter and logging information.

##Setup

//Set these variables to turn on (TRUE) or off (FALSE) certain features
//When finished, rename this file to config.php

	//Go to http://ipinfodb.com/ to create an account and get your own api key
	//Your api key will be a long string of numbers and letters, replace 'yourapikey' below with this string