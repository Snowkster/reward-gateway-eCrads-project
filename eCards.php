<?php
    include_once 'header.php';
?>

<?php  
		$connect = mysqli_connect("localhost", "root", "123123", "phpeCardProject");  
		if(isset($_POST["insert"]))  
		{  
			$file = addslashes(file_get_contents($_FILES["image"]));  
			$query = "INSERT INTO eCards (cardName, cardCategory, cardPrice, address, description, cardImg) VALUES(?, ?, ?, ?, ?, ?);";  

			$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, $query);
			mysqli_stmt_bind_param($stmt, "ssssss", $cardName, $cardCategory, $cardPrice, $address, $description, $cardImg);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
 };
 ?>
	<section className="signup-form">
		<?php
		if (isset($_SESSION['userid'])) {
		echo "<h2>Create eCard</h2>
			<form action='eCrds.php' method='post'>
				<input type='text' name='cardName' placeholder='Card Name...'>
					<br></br>
				<select name='cardCategory' id='category'>
    				<option value='' selected='selected'>Choose</option>
					<option value=''>Anniversary</option>
					<option value=''>Birthdays</option>
					<option value=''>Special Events</option>
  				</select>
					<br></br>
				<input type='text' name='price' placeholder='Card Price...'>
					<br></br>
				<input type='text' name='address' placeholder='Address...'>
					<br></br>
				<input type='text' name='description' placeholder='Description...'>
					<br></br>
				<input type='file' name='cardImg' placeholder='Choose file'>
					<br></br>
				<button type='submit' name='insert' id='insert' value='insert'>Create card</button>
			</form>
			
			<script>  
			$(document).ready(function(){  
				 $('#insert').click(function(){  
					  var image_name = $('#image').val();  
					  if(image_name == '')  
					  {  
						   alert('Please Select Image');  
						   return false;  
					  }  
					  else  
					  {  
						   var extension = $('#image').val().split('.').pop().toLowerCase();  
						   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
						   {  
								alert('Invalid Image File');  
								$('#image').val('');  
								return false;  
						   }  
					  }  
				 });  
			});  
			</script>
			";
		}
			?>
	</section>	

<?php
			include_once("includes/dbh.inc.php");
			$sql = "SELECT * FROM eCards";
			$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));			
			while( $record = mysqli_fetch_assoc($resultset) ) {
			?>
            <div class="card hovercard">
                <div class="cardheader">               
					<div class="avatar">
						<img alt="" src="<?php echo $record['cardImg']; ?>">
					</div>
				 </div>
                <div class="card-body info">
                    <div class="title">
                        <a href="#"><?php echo $record['cardName']; ?></a>
                    </div>
					<div class="desc"> <?php echo $record['cardCategory']; ?></div>		
                    <div 
class="desc"><?php echo $record['description']; ?></div>      
					<div 
class="desc"><?php echo $record['address']; ?></div>								
                </div>
            </div>
			<?php } ?>

<?php
    include_once 'footer.php';
?>