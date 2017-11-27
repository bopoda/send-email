# sendEmail

The easiest way to run an application:

- composer install

- Set correct database credentials in config/default.ini

- run local server:

  cd project
  
  php -S localhost:8000
  
  open address http://127.0.0.1:8000/
 
sql to apply:
<pre>
CREATE TABLE `email` (
   `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `added_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
   `updated_at` timestamp NULL DEFAULT NULL,
   `name` varchar(50) DEFAULT NULL,
   `email` varchar(255) NOT NULL,
   `subject` varchar(255) NOT NULL,
   `message` text,
   `attachments` text,
   `success` tinyint(1) NOT NULL DEFAULT '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
</pre>