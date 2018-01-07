<?php
/*
1. Create a grid
2. Choosing 'n' random points on the grid
3. Receiving the path for those n random points as coordinates
4. Generating signals for micro-controller

*/

//defining grid parameters
define("gridHeight", 10);
define("gridWeight", 10);
$n = 6; //no. of chosen points

//genmerate a grid
$grid = array(gridHeight);
for($i = 0; $i < gridHeight; $i++) {
	$grid[$i] = array(gridWeight);
}

//entering values in that grid
for($i = 0; $i < gridHeight; $i++) {
	for($j = 0; $j < gridWeight; $j++) {
		$grid[$i][$j] = 0;
	}	
}

//print the grid
for($i = 0; $i < gridHeight; $i++) {
	for($j = 0; $j < gridWeight; $j++) {
		echo $grid[$i][$j];
	}
	echo "\n";	
}
echo "\n\n";
//Choosing n random points on the grid
$flag = 0;
for($i = 0; $i < $n; $i++) {
	while($flag != 1) {
		$x = rand(0,gridWeight-1);
		$y = rand(0,gridHeight-1);
		if($grid[$x][$y] == 0) {
			$grid[$x][$y] = 1;
			$flag = 1;
		}
	}
	$flag = 0;
}

for($i = 0; $i < gridHeight; $i++) {
	for($j = 0; $j < gridWeight; $j++) {
		echo $grid[$i][$j];
	}
	echo "\n";	
}

//saving those n points in points array
$points = array($n);
$count = 0;
for($i = 0; $i < gridHeight; $i++) {
	for($j = 0; $j < gridWeight; $j++) {
		if($grid[$i][$j] == 1) {
			$points[$count] = array(2);
			$points[$count][0] = $i;
			$points[$count][1] = $j;
			$count++;
		}	
	}
}
echo "\n";

//displaying those n points
for($i = 0; $i < $n; $i++) {
	echo $points[$i][0];
	echo "  ";
	echo $points[$i][1];
	echo "\n";
}

//Path to be received from TSP alfo (javascript)
//currently assuming the the current order of vertices in points is the path

//generating signals
for($k = 0; $k < $n-1; $k++) {
	$x = $points[$k+1][0] - $points[$k][0];
	$y = $points[$k+1][1] - $points[$k][1];
		
	//Vertical movement
	if($x > 0) {
		for($i = 0; $i < $x; $i++) {
			echo "down ";
		}
	}
	else {
		for($i = 0; $i < (-1*$x); $i++) {
			echo "up ";
		}
	}

	//Horizontal movement
	if($y > 0) {
		for($i = 0; $i < $y; $i++) {
			echo "right ";
		}
	}
	else {
		for($i = 0; $i < (-1*$y); $i++) {
			echo "left ";
		}
	}
	echo "\n";
}	


?>