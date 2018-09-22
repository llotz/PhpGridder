<?php
require_once("PhpGridder.php");
?>
<head>
	<style>
		<?=file_get_contents("style.css");?>
	</style>
</head>
<body>
<?php
$databaseStuff = array(
  array("ColumnTitle1" => "Col1Cell1", "ColumnTitle2" => "Col1Cell2", "ColumnTitle3" => "Col1Cell3"),
  array("ColumnTitle1" => "Col2Cell1", "ColumnTitle2" => "Col2Cell2", "ColumnTitle3" => "Col2Cell3")
);
$phpGridder = new PhpGridder($databaseStuff);

$plainHtmlGrid = $phpGridder->renderGrid();

echo $plainHtmlGrid;


?>
</body>