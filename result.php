<?php


$tab1 = [[0, 3], [6, 10]];
$tab2 = [[0, 5], [3, 10]];
$tab3 = [[0, 5], [2, 4]];
$tab4 = [[7, 8], [3, 6], [2, 4]];
$tab5 = [[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]];

// sort intervals by min offset.

function sortIntervals(Array $tab):Array{
	
	$tab2 = [];
	foreach($tab as $element){
		sort($element);
		if(array_key_exists($element[0],$tab2))
			$tab2[$element[0]]< $element[1] ? $tab2[$element[0]]= $element[1]: $tab2[$element[0]];
		else  $tab2[$element[0]]= $element[1];
	}
	ksort($tab2);
	$recoveredArray = [];
	foreach($tab2 as $key=>$value){
		array_push( $recoveredArray, [$key,$value]);
	}
	return $recoveredArray;
}


// Union of interfaces
function foo(Array $tab):Array{
	
	$finalArray = [];

	for( $i=0; $i< count($tab)-1; $i++){
		var_dump("i: ".$i);
		$tempInterval = $tab[$i];
		for($j=$i+1;$j<count($tab); $j++){
			var_dump("j: ".$j);
            //if intervals don't intersect
			if($tempInterval[1]<$tab[$j][0]){
                // to include the last element of array
				if($j==count($tab)-1){
					array_push($finalArray, $tempInterval,$tab[$j]);
					break 2;
				}else
				$i= $j-1 ;
				break;
			}
			else{
				$tempInterval = [$tempInterval[0], max($tempInterval[1],$tab[$j][1])];
				
			}
			}
		array_push($finalArray, $tempInterval);
	}
	return $finalArray;
}
echo "result of :[[0, 3], [6, 10]] :";
echo "<br>";
print_r(foo(sortIntervals($tab1)));
echo "<br>";echo "<br>";
echo "result of :[[0, 5], [3, 10]] :";
echo "<br>";
print_r(foo(sortIntervals($tab2)));
echo "<br>";echo "<br>";
echo "result of :[[0, 5], [2, 4]] :";
echo "<br>";
print_r(foo(sortIntervals($tab3)));
echo "<br>";echo "<br>";
echo "result of :[[7, 8], [3, 6], [2, 4]] :";
echo "<br>";
print_r(foo(sortIntervals($tab4)));
echo "<br>";echo "<br>";
echo "result of :[[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]] :";
echo "<br>";
print_r(foo(sortIntervals($tab5)));