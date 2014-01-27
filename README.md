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

###Database setup

At this point there is an assumption about the user's knowledge set, and that at a very basic level the user understands database management and can run an SQL query on their database.

To initialize the database, run the SQL query in ```shorturl.sql``` on your server. This initializes two tables: the link association table, and the hit counter and analytics table

###Configuration

In your favorite php IDE or text editor, open up the ```config_template.php``` file. There are several variables that drive Short URL that rely on information specific to your server, hostname, and other setup particulars.

There are also some simple featureset on/off selections that you can turn on with a ```TRUE``` or ```FALSE``` assignment.

###Default Homepage

Whenever a client sends an http request to the domain either without a slug, or with a slug that has not yet been generated, Short URL will redirect it to this home page. Change ```example.com``` to whatever page you wish in the following line in the config_template file:
```php
//Default page for null or invalid slugs
	$homepage = 'http://www.example.com';
```

Note that you can redirect this to a 404 handling page if you desire.

###Database Connection

Next, we need to be able to connect to our database with our php files. This is done using mysqli() functions in php. You will need the database host name or IP address, and a username/password combination with read/write priveliges to said database. May hosting providers have _mostly_ easy to use web interfaces for acquiring and adminstering this information.

Once you have those necessary pieces of information, replace ```user```, ```pass```, and ```host url or ip``` with your user name, password, and database host name or IP. If you were savvy enough to change the name of the database in the above SQL command or otherwise, change the database name to reflect the new one here. Otherwise, leave it as the default ```shorturl```

```php
//Fill in your specific database variables here
	$database='shorturl';
	$username='user';
	$password='pass';
	$hostname='host url or ip';
```

###IP Geographic Lookup

This setting allows you to store location data about the user's IP address. You will need an API key for ipinfodb. Click [here](http://ipinfodb.com/login.php) and sign up for an account. It's free, and there are no newsletters, hooray! Once you've signed up you will be provided with a long API key, which will be a string of numbers and letters.

Now that you have an API key, replace ```yourapikey``` with the long string of letters and numbers you just received. Also switch the FALSE to TRUE to turn on this feature:

```php
//IP location lookup (country, region, city, zipcode etc.)	
	$apikey = 'yourapikey';
	$iptolocation = FALSE;
```

###Browser and OS information tracking

This setting provides specifics regarding the computer and browser that a client is using when accessing a Short Link.

Some server settings need to be edited to get this to work, and it can sometimes be a little tricky.

For starters, you need the latest copy of ```php_browscap.ini```, which you can download [here](http://tempdownloads.browserscap.com/). Be sure to grab the one that says _"Use only for PHP!"_.

Load that ini file somewhere on your server. It doesn't matter specifically where, but make a note of it.

Next, your ```php.ini``` file will need to point to the ```php_browscap.ini``` file. The actual name of ```php.ini``` is different for various server configurations, so it is left up to the user to determine exactly what it needs to be.

When you do locate the correct name and location for your ```php.ini``` file, paste in the following anywhere:
```
[browscap]
; http://php.net/browscap
browscap = "/absolute/path/to/file/php_browscap.ini"
```
Note that ```/absolute/path/to/file``` needs to be replaced with the _absolute path of the file from the server's perspective._ This is not just your home directory, it's the full location of the file starting from the highest mounting point / (or C:\ for the windows server users out there).

There are a lot of varying setups and places that this could go wrong, so best wishes to those setting this up.

Finally, if you manage to sort through all of the server-side setup, you just simply need to change ```FALSE``` to ```TRUE``` in the following line in the ```config_template.php``` file:

```php
//Browser and OS information tracking
	$browsertrack = FALSE;
```

###Rename File
After you've decided and input all of your configurations, change the name of ```config_template.php``` to ```config.php```.

---

Congratulations, you've now set up Short URL! Add some associations in the ```links``` database (```short``` is the name of the slug you want, and ```long``` is the url you want that slug to point to), and you're off to the races!