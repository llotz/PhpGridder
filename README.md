# PhpGridder
A simple but powerful, highly customizable php class to render plain html of a data array in just a few lines of code.

Here's an [example output](https://htmlpreview.github.io/?https://github.com/llotz/PhpGridder/blob/master/preview.html)

## Preferences

PHP >= 5.3  -- I'm sure it works with older versions but i haven't tested it. 

Thats it. No dependencies to download or composer libraries to install.

## Installation

You can clone this repository or just copy the contents of src/PhpGridder.php to your project and include it as shown in the src/example/index.php. To get the basic style as shown in the preview.html just copy the contents of the src/style.css to your projects .css or create a seperate css file for the gridder and include it.

## Initialization

Just give it an array you got from your database as a result of a query or so. 
```php
$phpGridder = new PhpGridder($databaseStuff);
```

The array has to have this format:
```php
$databaseStuff = array(
  array("ColumnTitle1" => "Row1Cell1", "ColumnTitle2" => "Row1Cell2", "ColumnTitle3" => "Row1Cell3"),
  array("ColumnTitle1" => "Row2Cell1", "ColumnTitle2" => "Row2Cell2", "ColumnTitle3" => "Row2Cell3")
);
```

In case you're using a mysql database i recommend using [PHP-Mysqli](https://github.com/ThingEngineer/PHP-MySQLi-Database-Class) which already deploys you the required format.

## Rendering

When you have configured everything, you can get your plain HTML like 
```php
$plainHtmlGrid = $phpGridder->renderHtml();
```

## Configuration

Every configuration that is done by an array takes multiple configuration options of the defined type.

### cellDivClasses

This option adds a div class to a Cell with a given Name. In this case every cell with the column name ColumnTitle2 gets the div class highlight-cell.

```php
$cellDivClassConditions = array(
     array("ColumnTitle2", "highlight-cell")
);
$phpGridder->cellDivClassConditions = $cellDivClassConditions;
```

### rowDivClassConditions

This adds a div class to all rows where ColumnTitle2 equals Row2Cell2. You can style this div tag in your css.

```php
$rowDivClassConditions = array(
    array("ColumnTitle2", "Row2Cell2", "highlight-row")	
  );
$phpGridder->rowDivClassConditions = $rowDivClassConditions;
```

### cellDivClassConditions

This adds a div class to a given cell where ColumnTitle2 equals Row2Cell2. 

```php
$cellDivClassConditions = array(
		array("ColumnTitle1", "ColumnTitle2", "Row1Cell2", "highlight-cell")
);
$phpGridder->cellDivClassConditions = $cellDivClassConditions;
```

### columnsToHide

If you want to hide columns just do it like this.

```php
$phpGridder->columnsToHide = array("ColumnTitle2", "ColumnTitle3");
```

### rowLinks

In case you want to link a whole row with a value from your datagrid. In this case you will get the link from example/%valueOfColumnTitle2%

```php
$phpGridder->rowLinks = array("example/%s", "ColumnTitle2");
```

### cellLinks

You can as well link row values to single cells like:
```php
$phpGridder->cellLinks = array("ColumnTitle1" => array("example/%s", "ColumnTitle2"));
```
Here the value of "ColumnTitle1" gets linked to example/%valueOfColumnTitle2%

### columnWidths

You can declare maxwidths for your columns
```php
$phpGridderWidth->columnWidths = array("ColumnTitle1" => 150,
                      "ColumnTitle3" => 300);
```

### showHeadRow

If you don't want the title row to be shown, just turn it off

```php
$phpGridder->showHeadRow = false;
```

## Change standard div tags
If you want to customize the standard div container names that come with PhpGridder, you can just customize them and adjust the css file.

```php
$phpGridder->classNameMain = "phpgridder-table";

$phpGridder->classTitleRow = "phpgridder-titlerow";

$phpGridder->classTitleCell = "phpgridder-titlecell";

$phpGridder->classRow = "phpgridder-row";

$phpGridder->classCell = "phpgridder-cell";

$phpGridder->classOddRow = "phpgridder-odd-row";

$phpGridder->classEvenRow = "phpgridder-even-row";

```
