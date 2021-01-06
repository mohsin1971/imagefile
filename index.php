<?php include 'inc/header.php';?>
<?php include 'lib/config.php'?>
<?php include 'lib/database.php'?>

<?php
$db = new database();

?>

 <div class="myform">
     <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.',$file_name);
        $file_ext = strtolower(end($div));
        $unic_image = substr(md5(time()), 0,10).'.'.$file_ext;
        $uploaded_image = "uploades/".$unic_image;

        if(empty($file_name)){

            echo "please uploade any image";
        }elseif($file_size >1000000){
            echo "file size must be 1kb";
        }elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-"
            .implode(', ', $permited)."</span>";
                }else{
        
        move_uploaded_file($file_temp, $uploaded_image);
        $query = "INSERT INTO tbl_image(image) VALUES('$uploaded_image')";
        $inserted_rows = $db->insert($query);
        if ($inserted_rows) {
         echo "<span class='success'>Image Inserted Successfully.
              </span>";
        }else {
         echo "<span class='error'>Image Not Inserted !</span>";
        }
       }
    }
     ?>
     <>
  <form action="" method="post" enctype="multipart/form-data">
   <table>
    <tr>
     <td>Select Image</td>
     <td><input type="file" name="image"/></td>
    </tr>
    <tr>
     <td></td>
     <td><input type="submit" name="submit" value="Upload"/></td>
    </tr>
   </table>
  </form>
    <?php
    $query = "SELECT * FROM tbl_image order by id desc limit 1";
    $getimage = $db->select($query);
    if($getimage){
        while($result = $getimage->fetch_assoc()){
            ?><img src="<?php echo $result['image']; ?>" height="100px" 
            width="200px"/>
           <?php } } ?>
 </div>
<?php include 'inc/footer.php';?>