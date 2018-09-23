<?php
require_once("PhpGridder.php");
?>
<head>
	<style>
		<?=file_get_contents("style.css");?>
		<?=file_get_contents("examples.css");?>
	</style>
</head>
<body>
<h3>Plain Grid</h3>
<p>No configuration done here</p>
<?
	$databaseStuff = array(
	array("ColumnTitle1" => "Row1Cell1", "ColumnTitle2" => "Row1Cell2", "ColumnTitle3" => "Row1Cell3"),
	array("ColumnTitle1" => "Row2Cell1", "ColumnTitle2" => "Row2Cell2", "ColumnTitle3" => "Row2Cell3")
	);

	$phpGridder = new PhpGridder($databaseStuff);
	$plainHtmlGrid = $phpGridder->renderHtml();
	echo $plainHtmlGrid;
?>

<h3>rowDivClassConditions</h3>
<p>this adds a DivClass named "highlight-row" to all rows where ColumnTitle2 equals Row2Cell2 (green here)</p>
<?
	$rowDivClassConditions = array(
			array("ColumnTitle2", "Col2Cell2", "highlight-row")	
		);
	$phpGridderRowCon = new PhpGridder($databaseStuff);
	$phpGridderRowCon->rowDivClassConditions = $rowDivClassConditions;

	$plainHtmlGrid = $phpGridderRowCon->renderHtml();
	echo $plainHtmlGrid;
?>

<h3>cellDivClassConditions</h3>
<p>this adds a DivClass named "highlight-cell" to all cells of the row x named ColumnTitle1 where ColumnTitle2 equals Row1Cell2</p>
<?
	$rowDivClassConditions = array(
		array("ColumnTitle1", "ColumnTitle2", "Col1Cell2", "highlight-cell")
	);
	$phpGridderCellCon = new PhpGridder($databaseStuff);
	$phpGridderCellCon->cellDivClassConditions = $rowDivClassConditions;

	$plainHtmlGrid = $phpGridderCellCon->renderHtml();
	echo $plainHtmlGrid;
?>

<h3>columnsToHide</h3>
<p>Columns that should not be shown. "ColumnTitle2" and "ColumnTitle3" in this case.</p>
<?
	$phpGridderHiddenColumns = new PhpGridder($databaseStuff);
	$phpGridderHiddenColumns->columnsToHide = array("ColumnTitle2", "ColumnTitle3");
	echo $phpGridderHiddenColumns->renderHtml();
?>

<h3>rowLinks</h3>
<p>Links that get added to Rows. In this example the whole Row gets Linked to example/%Value of ColumnTitle2%</p>
<?
	$phpGridderLinksRow = new PhpGridder($databaseStuff);
	$phpGridderLinksRow->rowLinks = array("example/%s", "ColumnTitle2");
	echo $phpGridderLinksRow->renderHtml();

?>

<h3>cellLinks</h3>
<p>You can as well link row values to single cells</p>
<?
	$phpGridderLinksCell = new PhpGridder($databaseStuff);
	$phpGridderLinksCell->cellLinks = array("ColumnTitle1" => array("example/%s", "ColumnTitle2"));
	echo $phpGridderLinksCell->renderHtml();
?>

<h3>columnWidths</h3>
<p>You can declare maxwidths for your columns</p>
<?
	$phpGridderWidth = new PhpGridder($databaseStuff);
	$phpGridderWidth->columnWidths = array("ColumnTitle1" => 150,
											"ColumnTitle3" => 300);
	echo $phpGridderWidth->renderHtml();
?>

<h3>showHeadRow</h3>
<p>If you don't want the title row to be shown, just switch it off</p>
<?
	$phpGridderTitle = new PhpGridder($databaseStuff);
	$phpGridderTitle->showHeadRow = false;
	echo $phpGridderTitle->renderHtml();
?>

</body>