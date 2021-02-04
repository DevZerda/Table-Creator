<?php

/*

                CUSTOM TABLE CREATOR

                    HOW TO USE

*/


/*

<?php

INCLUDE FILE                        include("./creator.php");                   File Inclusion

Define variable calling class       new Creator();                              Calling Class

Create create ya colum sizes        set_columns([10, 30, 14]);                  Regular Function

Create you're header                createHeader(["test", "test", "test"]). "\r\n";                     Return Value Function

Create you're row                   createRow(["test", "test", "test"]);        Return Value Function

Create you're footer                createFooter() ;                            Return value Function
*/

class Creator
{
    public $cols;

    public $UpperLeft_Corner = "╔";
    public $UpperRight_Corner = "╗";

    public $MiddleLine = "═";
    public $MiddleDownLine = "╦";
    public $MiddleUpLine = "╩";
    public $MiddleEdge = "║";
    public $Cross = "╬";
    public $LeftLineLeft = "╠";
    public $RightLineRight = "╣";

    public $BottomLeft_Corner = "╚";
    public $BottomRight_Corner = "╝";


    // set_columns(["20", ""])
    public function set_columns($columns) {
        if(!is_array($columns)) die("Error, Invalid Argument Value!");
        $this->cols = $columns;
    }

    public function addString($str, $addstr) {
        return $str. $addstr;
    }

    public function createHeader($col_value) {
        if(!is_array($col_value)) die("Error, Invalid argument value!");
        $replyThis = $this->UpperLeft_Corner;
        $lastHeaderLine = $this->LeftLineLeft;

        foreach($this->cols as $colsz) {
            for($c = 0; $c < $colsz; $c++) {
                $replyThis = $this->addString($replyThis, $this->MiddleLine);
                $lastHeaderLine = $this->addString($lastHeaderLine, $this->MiddleLine);
            }
            $replyThis = $this->addString($replyThis, $this->MiddleDownLine);
            $lastHeaderLine = $this->addString($lastHeaderLine, $this->Cross);
        }
        $lastHeaderLine = $this->addString($lastHeaderLine, $this->RightLineRight);
        $lastHeaderLine = str_replace("╬╣", "╣", $lastHeaderLine);
        

        $second_line = $this->MiddleEdge. " ";
        if(count($col_value) < count($this->cols)) die("Error, To Much Arguments!");
        $new_c = 0;
        $results = "";
        $n = 2;
        foreach($col_value as $colsz) {
            $colsize = $this->cols[$new_c];
            if(count($colsz) < $colsize) {
                $leftover = $colsize-strlen($colsz);
                $this->addString($results, $leftover);
                $spaces = $this->makeSpace($leftover-$n);
                $this->addString(" ". $results, $spaces);
                $newstr = $this->addString($colsz, $spaces);
                $this->addString($results, $newstr);
                $second_line = $this->addString($second_line, $newstr);
                $second_line = $this->addString($second_line, $this->MiddleEdge. " ");
            } else {
                die("Error, Invalid Value. More Than The Column Size!");
            }
            $new_c++;
            // $n++;
        }
        $second_line = $this->addString($second_line, $this->MiddleEdge);
        $second_line = str_replace("║ ║", "║", $second_line);

        
        $replyThis = $this->addString($replyThis, $this->UpperRight_Corner);
        $replyThis = str_replace("╦╗", "╗", $replyThis);
        return $replyThis. "\r\n". $second_line. "\r\n". $lastHeaderLine;
    }

    public function makeSpace($c) {
        $replyThis = "";
        for($i = 0; $i <= $c; $i++) {
            $replyThis = $this->addString($replyThis, " ");
        }
        return $replyThis;
    }

    public function createRow($col_value) {
        if(!is_array($col_value)) die("Error, Invalid argument value!");
        $replyThis = $this->MiddleEdge. " ";
        if(count($col_value) < count($this->cols)) die("Error, To Much Arguments!");
        $new_c = 0;
        $results = "";
        $n = 2;
        foreach($col_value as $colsz) {
            $colsize = $this->cols[$new_c];
            if(count($colsz) < $colsize) {
                $leftover = $colsize-strlen($colsz);
                $spaces = $this->makeSpace($leftover-$n);
                $newstr = $this->addString($colsz, $spaces);
                $replyThis = $this->addString($replyThis, $newstr);
                $replyThis = $this->addString($replyThis, $this->MiddleEdge. " ");
            } else {
                die("Error, Invalid Value. More Than The Column Size!");
            }
            $new_c++;
            // $n++;
        }
        $replyThis = $this->addString($replyThis, $this->MiddleEdge);
        $replyThis = str_replace("║ ║", "║", $replyThis);
        return $replyThis;
    }

    public function createFooter() {
        $replyThis = $this->BottomLeft_Corner;

        foreach($this->cols as $colsz) {
            for($c = 0; $c < $colsz; $c++) {
                $replyThis = $this->addString($replyThis, $this->MiddleLine);
            }
            $replyThis = $this->addString($replyThis, $this->MiddleUpLine);
        }

        $replyThis = $this->addString($replyThis, $this->BottomRight_Corner);
        $replyThis = str_replace("╩╝", "╝", $replyThis);
        return $replyThis;
    }
}
