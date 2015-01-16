<?php

function print_equation($a, $b, $c, $d, $e)
{
	echo "(".$a."*x⁴) + (".$b."*x³) + (".$c."*x²) + (".$d."*x) + (".$e.") = 0\n";
}

function res_equa_4($a, $b, $c, $d, $e, $x)
{
	return (($a * pow($x, 4)) + ($b * pow($x, 3)) + ($c * pow($x, 2)) + ($d * $x) + $e);
}

function derivative($a, $b, $c, $d, $x)
{
	return ((4 * $a) * pow($x, 3) + (3 * $b) * pow($x, 2) + (2 * $c) * $x + $d);
}

function method_bissection($a, $b, $c, $d, $e, $n)
{
	$x1 = 0;
	$x2 = 1;
	$i = 0; 
	print_equation($a, $b, $c, $d, $e);
	echo "Méthode de la bissection\npoint initial 1 : 0\npoint initial 2 : 1\n";
	while (($x2 - $x1) > pow(10, -$n)) 
	{
		$xm = ($x1 + $x2) / 2;
		$f_xm = res_equa_4($a, $b, $c, $d, $e, $xm);
		$f_x1 = res_equa_4($a, $b, $c, $d, $e, $x1);
		if (($f_x1 * $f_xm) >= 0)
			$x1 = $xm;
		else 
			$x2 = $xm;
		$i++;
		echo "itération ".$i."\tx = ".number_format($xm, $i)."\n";
		if ($i > 100)
		{
			echo "iteration's number too big after 100!!\n";
			exit(0);
		}
	}
	$res = res_equa_4($a, $b, $c, $d, $e, $xm);
	echo "f(x) = ".number_format($res, 21)."\n";
}

function method_Newton($a, $b, $c, $d, $e, $n)
{
	$xn = 0.5;
	$i = 1; 
	print_equation($a, $b, $c, $d, $e);
	echo "Méthode de Newton\npoint initial : 0,5\n";
	$f_xn = res_equa_4($a, $b, $c, $d, $e, $xn);
	$d_xn = derivative($a, $b, $c, $d, $xn);
	if ($d_xn == 0) 
	{
		echo "Error : a division by zero will be executed !!! Bad method !!!\n";
		exit(1);
	}
	$xn = $xn -($f_xn / $d_xn);
	while (abs($f_xn) > pow(10, -$n))
	{
		echo "itération ".$i."\tx = ".number_format($xn, 15)."\n";
		$f_xn = res_equa_4($a, $b, $c, $d, $e, $xn);
		$d_xn = derivative($a, $b, $c, $d, $xn);
		if ($d_xn == 0)
		{	
			echo "Error : a division by zero will be executed !!! Bad method !!!\n";
			exit(1);
		}
		$xn = $xn - ($f_xn / $d_xn);
		$i++;
		if ($i > 100)
		{
			echo "Nombre d'itération trop grand après 100!!\n";
			exit(0);
		}
	}
	echo "f(x) = ".number_format($f_xn, 21)."\n";
}

function method_secante($a, $b, $c, $d, $e, $n)
{
	$xn_moins = 0.4;
	$xn = 0.8;
	$i = 1; 
	print_equation($a, $b, $c, $d, $e);
	echo "Méthode de la sécante\npoint initial 1 : 0,4\npoint initial 2 : 0,8\n";
	$f_xn_moins = res_equa_4($a, $b, $c, $d, $e, $xn_moins);
	$f_xn = res_equa_4($a, $b, $c, $d, $e, $xn);
	$tmp = $xn;
	if ($f_xn == $f_xn_moins) 
	{
		echo "Error : a division by zero will be executed !!! Bad method !!!\n";
		exit(1);
	}
	$xn = $xn -(($f_xn * ($xn - $xn_moins)) / ($f_xn - $f_xn_moins));
	$xn_moins = $tmp;
	while (abs($f_xn) > pow(10, -$n))
	{
		echo "itération ".$i."\tx = ".number_format($xn, 15)."\n";
		$f_xn_moins = res_equa_4($a, $b, $c, $d, $e, $xn_moins);
		$f_xn = res_equa_4($a, $b, $c, $d, $e, $xn);
		$tmp = $xn;
		if ($f_xn == $f_xn_moins)
		{	
			echo "Error : a division by zero will be executed !!! Bad method !!!\n";
			exit(1);
		}
		$xn = $xn -(($f_xn * ($xn - $xn_moins)) / ($f_xn - $f_xn_moins));
		$xn_moins = $tmp;
		$i++;
		if ($i > 100)
		{
			echo "Nombre d'itération trop grand après 100!!\n";
			exit(0);
		}
	}
	echo "f(x) = ".number_format($f_xn, 21)."\n";
}
?>