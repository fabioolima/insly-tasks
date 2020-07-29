<?php
function textBinASCII($text)
{
	$bin = array();
	foreach (str_split($text) as $val)
	{
		$bin[] = decbin(ord($val));
	}
    echo implode(' ', $bin) . ' ';
}
echo "<pre>";

$arrNome = ['F', 'A', 'B', 'I', 'O', ' ', 'L', 'I', 'M', 'A'];

foreach ($arrNome as $nome) {
	echo $nome;
}
print_r("\n");
array_map('textBinASCII', $arrNome);
print_r("\n");
foreach (str_split("FABIO LIMA") as $oneS)
{
	echo $oneS;	
}