<?php

class PhpGridder{

	public $dbArray;

    public $columnsToHide;

    public $columnLinks;

    public $rowDivClassConditions;
	
    public $cellDivClassConditions;
    
    public $columnWidths;

    public $showHeadRow = true;

    public $classNameMain = "phpgridder-table";

    public $classTitleRow = "phpgridder-titlerow";

    public $classTitleCell = "phpgridder-titlecell";

    public $classRow = "phpgridder-row";

    public $classCell = "phpgridder-cell";

    public $classOddRow = "phpgridder-odd-row";

    public $classEvenRow = "phpgridder-even-row";
	
    private $isRowLink;

    private $isCellLink;

    public function __construct($dbArray){
        if(is_array($dbArray))
            $this->dbArray = $dbArray;
        else throw new Exception("Given variable is not an array!");
    }

    public function renderGrid(){
        $renderedHtml = "<div class='{$this->classNameMain}'>";
        
        $renderedHtml .= $this->renderGridHeadRow();
        
        $renderedHtml .= $this->renderGridBody();

        $renderedHtml .= "</div>";
        return $renderedHtml;
    }

    function renderGridHeadRow(){
        if(!$this->showHeadRow) return "";
        if($this->dbArray[0] != ""){
            $renderedHtml .= "<div class='{$this->classTitleRow}'>";
            foreach($this->dbArray[0] as $key => $value){
                if(!is_array($this->columnsToHide) || count($this->columnsToHide)==0 || !in_array($key, $this->columnsToHide)){
                    $widthFormat = $this->getColumnWidthFormatString($key);
                    $renderedHtml .= "<div class='{$this->classTitleCell}'".$widthFormat."><b>" . $key . "</b></div>";
                }                
                
            }
            $renderedHtml .= "</div>";
        }
        return $renderedHtml;
    }

    function renderGridBody(){
        foreach($this->dbArray as $key => $row){
            $rowLink = $this->getRowLinkHtmlTag($row);
            $renderedHtml .= $rowLink;
            $oddEvenClass = ($key % 2 == 0)?" {$this->classEvenRow}":" {$this->classOddRow}";
            $divTags = $this->getRowDivClasses($row);
            $renderedHtml .= "<div class='{$this->classRow}".$divTags.$oddEvenClass."'>";
            foreach($row as $key => $value){
                if(!is_array($this->columnsToHide) || count($this->columnsToHide)==0 || !in_array($key, $this->columnsToHide)){
                    $divRowTags = $this->getCellDivClasses($row, $key);
                    $widthFormat = $this->getColumnWidthFormatString($key);
                	$renderedHtml .= "<div class='{$this->classCell}".$divRowTags."'".$widthFormat."><p>" . $value . "</p></div>";
				}
            }
            $renderedHtml .= "</div>";
            if($rowLink != "")
                $renderedHtml .="</a>";
        }
        return $renderedHtml;
    }

    function getRowLinkHtmlTag($row){
        if(is_array($this->columnLinks) && count($this->columnLinks) > 0 && !is_array($this->columnLinks[0]))
        {
            if(strlen($this->columnLinks[0]) == 0 || strlen($this->columnLinks[1]) == 0)
                return "";
            $rowLink = sprintf($this->columnLinks[0], $row[$this->columnLinks[1]]);
            return "<a href=".$rowLink.">";
        }
        else return "";
    }

    function getCellLink($row, $columnName){
        if(is_array($this->columnLinks) && is_array($this->columnLinks[0])){
            foreach ($this->columnLinks as $columnLink){
                if(is_array($columnLink) && array_key_exists($columnName, $columnLink) && count($columnLink) == 2)
                {
                    $rowLink = sprintf($columnLink[0], $row[$columnLink[1]]);
                    return "<a href=".$rowLink.">";
                }
            }
        }
        return "";
    }

    function getRowDivClasses($row){
        if($this->rowDivClassConditions == null || !is_array($this->rowDivClassConditions)) return "";
        $divTags = "";
        foreach($this->rowDivClassConditions as $condition){
            if($row[$condition[0]] == $condition[1])
                $divTags .= " ".$condition[2];
        }
        return $divTags;
    }
	
	function getCellDivClasses($row, $cellName){
        if($this->cellDivClassConditions == null || !is_array($this->cellDivClassConditions)) return "";
        
        foreach($this->cellDivClassConditions as $condition){
            if($condition[0] == $cellName && $row[$condition[1]] == $condition[2])
                $divTags .= " ".$condition[3];
        }
        return $divTags;
    }

    function getColumnWidthFormatString($cellName){
        if(is_array($this->columnWidths) && array_key_exists($cellName, $this->columnWidths)){
            return " style='max-width:".$this->columnWidths[$cellName]."'";
        }
        else return "";
    }
}
?>