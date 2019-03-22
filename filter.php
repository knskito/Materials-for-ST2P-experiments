<?php
$f = fopen("uspatentcitation.tsv", "r");
$i = 0;
while ( !feof($f) ) {
	$row = fgetcsv($f, 0, "\t");
	list($uuid, $patent_id, $citation_id, $date, $name, $kind, $country, $category, $sequence) = $row;

	$i ++;
	if ( $i % 10000 == 0 ) {
		fputs(STDERR, "Processing $i...\r");
	}

	if ( preg_match("/^([0-9]+)/", $date, $matches )) {
		list($_, $year) = $matches;
		$year = (int)$year;

		#if ( $year == 2000 ) {
		if ( $year >= 2013 and $year <= 2017 ) {
			fputcsv(STDOUT, $row);
		}
	}
}
