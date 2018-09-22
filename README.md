# PhpGridder
A simple but powerful php class to render plain html of a data array

I will put some Documentation and Examples here later on.

## Initialisation

Just give it an array you got from your database as a result of a query or so. 
```php
$phpGridder = new PhpGridder($databaseStuff);
```

The array has to have this format:
```php
$databaseStuff = array(
  array("ColumnTitle1" => "Col1Cell1", "ColumnTitle2" => "Col1Cell2", "ColumnTitle3" => "Col1Cell3"),
  array("ColumnTitle1" => "Col2Cell1", "ColumnTitle2" => "Col2Cell2", "ColumnTitle3" => "Col2Cell3")
);
```

In case you're using a mysql database i recommend using https://github.com/ThingEngineer/PHP-MySQLi-Database-Class which already deploys you the required format.

## Rendering

When you have configured everything, you can get your plain HTML like 
```php
$plainHtmlGrid = $phpGridder->renderGrid();
```

## Configuration

coming soon
