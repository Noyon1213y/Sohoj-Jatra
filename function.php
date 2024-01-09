<?php
include_once('../scripts/dbconnect.php');

function date_fomate_convert($originalDate)
{	
	$formate_date = date("d/m/Y", strtotime($originalDate));
	return $formate_date;
}
function get_member_info($id, $tbl_field)
{
	$sql = mysql_query("select $tbl_field from members_tb where id = '$id' limit 1 ");
	while($row = mysql_fetch_array($sql))
	{
		$tbl_field = $row[$tbl_field];
	}
	return $tbl_field;
}
function get_company_name($id)
{
	$sql = mysql_query("select company_name from members_tb where id = '$id' limit 1 ");
	while($row = mysql_fetch_array($sql))
	{
		$company_name = $row['company_name'];
	}
	return $company_name;
}

function get_user_name($id)
{
	$sql = mysql_query("select user_login from users_tb where id = '$id' limit 1 ");
	while($row = mysql_fetch_array($sql))
	{
		$user_name = $row['user_login'];
	}
	return $user_name;
}
function get_password($id)
{
	$sql = mysql_query("select user_pass from users_tb where id = '$id' limit 1 ");
	while($row = mysql_fetch_array($sql))
	{
		$password = $row['user_pass'];
	}
	return $password;
}
function get_profile($id)
{
	$sql = mysql_query("select * from users_tb where id = '$id' limit 1 ");
	while($row = mysql_fetch_array($sql))
	{
		$name = $row['name'];
		$email = $row['email'];
	  	echo 
		"	
	  	<table width=\"50%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" class=\"tablesorter\">		  
		  <tr>
			<td>Name</td>
			<td>$name</td>
		  </tr>
		  <tr>
			<td>E-mail</td>
			<td>$email</td>
		  </tr>
		</table> 
		" ;		
	}
}
function convert_number_to_words($number) {

    $hyphen      = ' ';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'One',
        2                   => 'Two',
        3                   => 'Three',
        4                   => 'Four',
        5                   => 'Five',
        6                   => 'Six',
        7                   => 'Seven',
        8                   => 'Eight',
        9                   => 'Nine',
        10                  => 'Ten',
        11                  => 'Eleven',
        12                  => 'Twelve',
        13                  => 'Thirteen',
        14                  => 'Fourteen',
        15                  => 'Fifteen',
        16                  => 'Sixteen',
        17                  => 'Seventeen',
        18                  => 'Eighteen',
        19                  => 'nineteen',
        20                  => 'Twenty',
        30                  => 'Thirty',
        40                  => 'Fourty',
        50                  => 'Fifty',
        60                  => 'Sixty',
        70                  => 'Seventy',
        80                  => 'Eighty',
        90                  => 'Ninety',
        100                 => 'Hundred',
        1000                => 'Thousand',
        1000000             => 'Million',
        1000000000          => 'Billion',
        1000000000000       => 'Trillion',
        1000000000000000    => 'Quadrillion',
        1000000000000000000 => 'Quintillion'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}

?>