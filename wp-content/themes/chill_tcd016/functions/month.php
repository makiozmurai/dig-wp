<?php

//  使い方　$month = get_the_date('M'); echo encode_date($month);

function encode_date($m){
	switch ($m) {
		case '1月':
		return 'Jan';
		break;
		case '2月':
		return 'Feb';
		break;
		case '3月':
		return 'Mar';
		break;
		case '4月':
		return 'Apr';
		break;
		case '5月':
		return 'May';
		break;
		case '6月':
		return 'Jun';
		break;
		case '7月':
		return 'Jul';
		break;
		case '8月':
		return 'Aug';
		break;
		case '9月':
		return 'Sep';
		break;
		case '10月':
		return 'Oct';
		break;
		case '11月':
		return 'Nov';
		break;
		case '12月':
		return 'Dec';
		break;
	}
}

?>