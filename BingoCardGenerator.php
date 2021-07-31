<?php

$bingoValues = array();

$ranges = array(
		[1,15],
		[16,30],
		[31,45],
		[46,60],
		[61,75]
	);

for ($x=0; $x<5; $x++) {
	$numbers = range($ranges[$x][0], $ranges[$x][1]);
	shuffle($numbers);
	$bingoValues[$x] = $numbers;
}

$bingoValues[2][2] = "FREE SPACE";

$bingoCard = "<tr><td>B</td><td>I</td><td>N</td><td>G</td><td>O</td></tr>";

for ($j=0; $j<5; $j++){
	$bingoCard .= "<tr>";
	for ($k=0; $k<5; $k++){
		$bingoCard .= "<td>" . $bingoValues[$k][$j] . "</td>";
	}
	$bingoCard .= "</tr>";
}
?>

<!DOCTYPE html>
<head>
	<title>BINGO KATA</title>
</head>
<style>
	td, th {
		width: 50px;
		border: 1px solid #ccc;
		text-align: center;
	}
</style>
<body>
	<button>Go!</button>
	<div id="number"></div>
	<h1>Bingo Results</h1>
	<div id="result"></div>
	<br />
	<table id="BingoCard">
		<div>
			<?php echo $bingoCard; ?>
		</div>
	</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$(function(){
	full = 0;
	maxNumber = 75;
	bingo = new Array();
	for(i = 1; i <= maxNumber; i++) {
		bingo.push(i);
	}
	buttonStatus = 0;

	$("button").click(function(){
		if(buttonStatus == 0) {
			buttonStatus = 1;
			$("button").text("Stop");
			roulette = setInterval(function(){
				random = Math.floor(Math.random() * bingo.length);
				number = bingo[random];
				$("#number").text(number);
			}, 90);
		} else {
			buttonStatus = 0;
			$("button").text("Start");
			clearInterval(roulette);
			random = Math.floor(Math.random() * bingo.length);
			result = bingo[random];
			bingo.splice(random, 1);

			$("#number").text(result);
			$("#result").append(result + ", ");

			$("#BingoCard td").each(function(k,v){
				if($(this).text() == result){
					$(this).css("background-color", "coral");
					full++;
				}
			});

			if(full == 24){
				alert("BINGO! You're the winner");
			}
		}
	});
});
</script>
</body>
</html>