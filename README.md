source-news
===========

Installation
------------

Dependencies

To get source-news running, you will need to have a working PHP 5 installation and a MySQL database. The other requirement is composer which can be installed from http://getcomposer.org/.


Installation

To install it you will need to clone the repository using:

	"git clone https://github.com/SourceNews/source-news.git"

Then run `composer install` which will download the required PHP dependencies and setup Laravel.

The database connection can be configured from within `config/database.php`. Once that is done, run `php artisan migrate` from the terminal so that the database tables are created. 
