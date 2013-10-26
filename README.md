sodot
=====================
Sodot is PHP application intended for allowing any user to post anonymous messages to any Facebook page.

## settings.ini
Copy the files into a any LAMP or WAMP server.
Edit settings.ini located in the main directory.
Fill in the following details: 

-  MySQL username
-  MySQL password
-  MySQL database name 
-  MySQL table (You can just use the default)
-  MySQL host (You can just use localhost if you don't know what is it)
-  Facebook page ID. You can find your Facebook page ID by going to this URL: http://graph.facebook.com/YOUR_FACEBOOK_PAGE_NAME and replace YOUR_FACEBOOK_PAGE_NAME with the name of the page or by using tools like http://findmyfacebookid.com/
-  The permanent Facebook access token of the application

## Generating permanent Facebook Access Token
-  Create Facebook application and get the APP KEY.
-  Install the application on your page by going to http://www.facebook.com/add.php?api_key={APP_KEY}&pages and replace the APP_KEY with your Facebook application ID.
-  get the Access token by going to here: https://developers.facebook.com/tools/explorer and choose your Facebook application and generate the token.
-  verify it by going to https://developers.facebook.com/tools/debug/access_token paste the access token and see -expires: never.

## Install
After configuring the settings.ini, Install the program by going into /index.php?page=install

## Use
To use the application just go to root directory and write message. It should appear in your facebook page.

## Test
Sodot is using PHPUnit testing frameworl. in order to test it, just go to the test directory and type 'phpunit .'

## Documentation
Documentation is available at /documentation/html/

## Regenerate doxygen
Sodot is using Doxygen to auto document. for regenerating the documentation, go to the root directory and type 'doxygen Doxyfile' 

## TODO:
1. Automate the FB application process.
2. Insert PHP testing.