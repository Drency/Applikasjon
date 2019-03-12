<!DOCTYPE html>
<html>
<body>
<button onclick="show()"></button>
<!-- <div id="test"></div> -->


<form action="upload.php" id="MyForm" method="post" enctype="multipart/form-data" style="display: none;">
    Select image to upload:
    <input type="file" name="photoimg" id="photoimg">
    <input type="submit" value="Upload Image" name="submit">
</form> 

<script>
    function show(){
        var i = 1;
        var form = document.getElementById("MyForm");
        if(i == 1){
            form.style = "display: block;";
            i == 0;
        }else if(i == 0){

        }
    }


</script>
</body>
</html>