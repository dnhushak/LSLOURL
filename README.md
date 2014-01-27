#Short URL

Short URL is a short url geneartor with stats tracking.

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

To start, you will need some sort of access to a domain name and web hosting, be it your own webserver or through a registrar's web hosting service.

In addition to just the http web space, you will also need access to a MySQL database, where all of the link associations and analytics will be stored.