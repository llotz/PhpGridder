<?php

class PhpGridder{

	public $dbArray;

    public $columnsToHide;

    public $rowLinks;

    public $cellLinks;

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

    public function __construct($dbArray){
        if(is_array($dbArray))
            $this->dbArray = $dbArray;
        else throw new Exception("Given variable is not an array!");
    }

    public function renderHtml(){
        $renderedHtml = "<div class='{$this->classNameMain}'>";
        
        $renderedHtml .= $this->renderGridHeadRow();
        
        $renderedHtml .= $this->renderGridBody();

        $renderedHtml .= "</div>";
        return $renderedHtml;
    }

    function renderGridHeadRow(){
		$renderedHtml = "";
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
		$renderedHtml = "";
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
                    $cellLink = $this->getCellLinkHtmlTag($row, $key);
                    $renderedHtml .= "<div class='{$this->classCell}".$divRowTags."'".$widthFormat.">";
                    $renderedHtml .= $cellLink;
                    $renderedHtml .="<p>" . $value . "</p>";
                    if($cellLink != "")
                        $renderedHtml .= "</a>";
                    $renderedHtml .= "</div>";
                }
            }
            $renderedHtml .= "</div>";
            if($rowLink != "")
                $renderedHtml .="</a>";
        }
        return $renderedHtml;
    }

    function getRowLinkHtmlTag($row){
        if(is_array($this->rowLinks) && count($this->rowLinks) > 0 && !is_array($this->rowLinks[0]))
        {
            if(strlen($this->rowLinks[0]) == 0 || strlen($this->rowLinks[1]) == 0)
                return "";
            $rowLink = sprintf($this->rowLinks[0], $row[$this->rowLinks[1]]);
            return "<a href=".$rowLink.">";
        }
        return "";
    }

    function getCellLinkHtmlTag($row, $columnName){
        if(is_array($this->cellLinks) && array_key_exists($columnName, $this->cellLinks)){
            $columnLink = $this->cellLinks[$columnName];
            if(strlen($columnLink[0]) == 0 || strlen($columnLink[1]) == 0)
                return "";
            $rowLink = sprintf($columnLink[0], $row[$columnLink[1]]);
            return "<a href=".$rowLink.">";
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
        $divTags = "";
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