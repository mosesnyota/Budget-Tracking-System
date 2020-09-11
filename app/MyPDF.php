<?php
namespace App;
use Codedge\Fpdf\Fpdf\Fpdf;

class MyPDF extends FPDF
{
var $widths;
var $aligns;



function Header()
{
    // Logo
	$this->Image('logo.png',10,6,30);
	$this->Image('donbosco.png',170,6,40);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Move to the right
    
	// Title
	$this->Cell(40);
	$this->Cell(120,0,'DON BOSCO DEVELOPMENT OUTREACH NETWORK',0,0,'C');
	$this->Ln(7);
	$this->SetFont('Arial','B',13);
	$this->Cell(40);
	$this->Cell(120,0,'P.O.BOX 62322-00200, NAIROBI , KENYA',0,0,'C');
	$this->Ln(7);
	$this->Cell(40);
	$this->Cell(120,0,'info@dbdon.org',0,0,'C');
	$this->Ln(7);
	$this->Cell(40);
	$this->Cell(120,0,'TEL: +254202724495, +254743794129',0,0,'C');
    // Line break
    $this->Ln(9);
}

function Footer()
{
    // Go to 1.5 cm from bottom
    $this->SetY(-15);
    // Select Arial italic 8
    $this->SetFont('Arial','I',8);
    // Print centered page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}



function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++){
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));}
	$h=7*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	$fill = 1;
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,7,$data[$i],0,$a,$fill);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);

		if($fill == 1){
			$fill = 0;
		}else{
			$fill = 1;
		}
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		{$this->AddPage($this->CurOrientation);}
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		{$w=$this->w-$this->rMargin-$this->x;}
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		{$nb--;}
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			{$sep=$i;}
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					{$i++;}
			}
			else
				{$i=$sep+1;}
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			{$i++;}
	}
	return $nl;
}
}
?>
