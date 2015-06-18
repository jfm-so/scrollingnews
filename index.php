<?php
//News
$scrolling="true"; //Define if text is scrolling or Still
//Config
$db_host="localhost";
$db_name="database";
$db_user="asdfg";
$db_pass="qwerty";
//Admin
$pass="admin"; //Used to add records
$con=mysqli_connect("$db_host","$db_user","$db_pass","$db_name");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL. Make sure to edit the config.php file: " . mysqli_connect_error();
  }
$result = mysqli_query($con,"SELECT * FROM news ORDER BY id DESC Limit 1");
while($news = mysqli_fetch_array($result))
{
if ($scrolling == "true"){
//Scrolling Text
?>

 <html> <marquee behavior="scroll" direction="left"><b><?php echo $news['title'];?>: </b> <?php echo $news['news']; ?></marquee>

<?php }
else { //Not Scrolling Text
?><b><?php
echo $news['title'];
?>
</b>:
<?php echo $news['news'];
}
}
//insert
if ($_GET['password'] == $pass){ //Verify admin password
if ($_POST['submit'] == "true"){ //See if news is being submited
$insert="INSERT INTO news (title, news)
VALUES
('$_POST[title]','$_POST[news]')";
if (!mysqli_query($con,$insert))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "Record Added, Please refresh!";}
else { //Show form to submit ?>
<form action="" method="post">
Title: <input type="text" name="title" required>
News: <input type="text" name="news" required>
Display?:
<input type="text" name="submit" value="true">
<input type="submit">
</form>
<?php }}
