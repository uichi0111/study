<?php
//fizzbuzz
for($i=1; $i<=100; $i++){
	if ($i % 15 == 0){
		echo 'FizzBuzz';
		}elseif ($i % 5 == 0){
			echo 'Buzz';
		}elseif ($i % 3 == 0){
			echo 'Fizz';
		}else{
			echo $i;
		}
			echo "\n";
}

echo "<BR>";

//調べる
//array_map(function($n){echo$n%15==0?'fizzbuzz':($n%5==0?'buzz':($n%3==0?'fizz':$n));},range(1,100));