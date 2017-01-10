Geographical Locations 
=======================
Country, state, county, city and zip codes with CRUD controls.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist derekisbusy/yii2-geo "*"
```

or add

```
"derekisbusy/yii2-geo": "*"
```

to the require section of your `composer.json` file.



### Update database schema

The last thing you need to do is updating your database schema by applying the
migrations. Make sure that you have properly configured `db` application component
and run the following command:

```bash
$ php yii migrate/up --migrationPath=@vendor/derekisbusy/geo/migrations
```

 Since there are lots of records in the migrations you may need to temporarily remove the memory limit in your index.php by adding the following. 

```php
php_ini('memory_limit', '-1');
```

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \derekisbusy\geo\AutoloadExample::widget(); ?>```