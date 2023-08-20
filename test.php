<?php
require ('RowExtractor.php');
$string = "پاکدشت ورامین	5719265041	علی رضامحمودابادی			9120950276	44ع415ایران16	2157051	گلیجین	8500	10300	0420050507 عبدالله تاجیک		9121361804	8	خ بگری	خ بگری	250	4.13																														";

$row=new RowExtractor($string);
echo(json_encode($row->ExtractByCharacter()));