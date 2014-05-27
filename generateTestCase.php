<?php

$counter = 0;




for ($a = 0; $a <= 1 ; $a++)
{
	if($a == 0)
	{echo "X";}else{echo "O";}
	for ($b = 0; $b <= 1 ; $b++)
	{
		if($b == 0)
		{echo "X";}else{echo "O";}
		for ($c = 0; $c <= 1 ; $c++)
		{
			if($c == 0)
			{echo "X";}else{echo "O";}
			for ($d = 0; $d <= 1 ; $d++)
			{
				if($d == 0)
				{echo "X";}else{echo "O";}
				for ($e = 0; $e <= 1 ; $e++)
				{
					if($e == 0)
					{echo "X";}else{echo "O";}
					for ($f = 0; $f <= 1 ; $f++)
					{
						if($f == 0)
						{echo "X";}else{echo "O";}
						
						if($counter == 5)
						{
							echo "<br>";
							$counter = 0;
						}
						else{$counter++;}
						
					}
				}
			}
		}
	}
}

	
?>