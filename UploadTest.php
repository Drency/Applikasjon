<?php 
include_once __DIR__ . '/include/header.php';

?>


<form action="include/upload.php" class="text-center m-2" method="post" enctype="multipart/form-data">
    <div class="form-group text-center">
        <input type="file"name="photoimg" id="photoimg">
    </div>
    <div class="form-group text-center">
        <input type="submit" class="btn btn-primary" value="Upload Image" name="submit">
    </div>
</form> 


<?php

include_once __DIR__ . '/include/footer.php';