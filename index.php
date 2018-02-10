<?php
	include_once('wordlist.php');
	$letters=isset($_POST['letters'])?$_POST['letters']:NULL;
	$num_of_letters=isset($_POST['num'])?$_POST['num']:NULL;
	
	//this function works fine
	function checkLetter($letter,$letters){
		$j=0;
		$good=1;
		
		if(sizeof($letters)!=0){
		while($j<sizeof($letters)){
			if($letter==$letters[$j]){
				$good=1;
				return $j;
			}
			else{
				$good=-1;
			}
			$j++;
		}
		}
		else{
			return -1;
		}
		return $good;
	}
	
	
	
	
	function checkWord($word,$letters,$num){
		$letterss=str_split($letters);
		$wordletters=str_split($word);
		
		
		$good=1;
		$count=0;
		
		//start of going through all the letters in the word
		if($num!=NULL){
			if(sizeof($wordletters)==$num){
				foreach($wordletters as $wordletter){
					if(checkLetter($wordletter,$letterss)!=-1){
						$count++;
						$k=checkLetter($wordletter,$letterss);
						unset($letterss[$k]);
						$letterss=array_values($letterss);
					}
				}
			}
		}
		else{
			foreach($wordletters as $wordletter){
				if(checkLetter($wordletter,$letterss)!=-1){
					$count++;
					$k=checkLetter($wordletter,$letterss);
					unset($letterss[$k]);
					$letterss=array_values($letterss);
				}
			}
		}
		//end of going through the letters of the word
		
		//echo $count;
		
		if($count==sizeof($wordletters)){
			$good=1;
		}
		else{
			$good=-1;
		}
		return $good;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Word Generator</title>
</head>

<body>
<form name="word" action="" method="post">
Letters: <input type="text" name="letters" /><br />
Number of Letters: <input type="text" name="num" /><br />
<input type="submit" value="Submit" />
</form>
<?php
	foreach($words as $word){
		if(checkWord($word,$letters,$num_of_letters)!=-1){
			echo $word . "<br />";
		}
	}
?>
</body>
</html>