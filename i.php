<?php

function test($num){
	echo $num.' ';
	if($num>0){
		test($num-1);
	}else{
		echo '<--->';
	}

	echo $num.' ';
}

test(1);


