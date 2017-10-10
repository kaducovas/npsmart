			<?php 
		
		foreach($result as $row){
			$rnc = $row->rnc;
			$cellname =  $row->cellname;
			$date[] = $row->datetime; 
		}
		echo join($data, ',')
		?>
