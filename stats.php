<?php
$f = fopen("uspatentcitation.tsv", "r");
$i = 0;
$years = array();
while ( !feof($f) ) {
	$row = fgetcsv($f, 0, "\t");
	list($uuid, $patent_id, $citation_id, $date, $name, $kind, $country, $category, $sequence) = $row;

	$i ++;
	if ( $i % 10000 == 0 ) {
		ksort($years);
		print_r($years);
		fputs(STDERR, "Processing $i...\r");
	}

	if ( preg_match("/^([0-9]+)/", $date, $matches )) {
		list($_, $year) = $matches;
		$year = (int)$year;
		if ( $year > date("Y") ) continue;

		if ( !isset($years[$year]) ) {
			$years[$year] = 0;
		}
		$years[$year] ++;
	}
}

ksort($years);
print_r($years);
