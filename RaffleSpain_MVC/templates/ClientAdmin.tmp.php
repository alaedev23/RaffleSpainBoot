<section id="admin" style="min-height: calc(100vh - 425px)">

	<?php 
    	if ($errors !== "") {
    	    echo "<div class=\"errorMessage\"><p>$errors</hp></div>";
    	}
    	echo $clientTemplate; 
    ?>

</section>