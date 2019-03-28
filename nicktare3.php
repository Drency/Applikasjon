<?php
session_start();
// Include the database configuration file
$db = mysqli_connect('localhost', 'root', '', 'app');

// Get images from the database
$query = $db->query("SELECT * FROM bilder");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["bildeLink"];
?>
    <img src="<?php echo $imageURL; ?>" alt="" />
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>