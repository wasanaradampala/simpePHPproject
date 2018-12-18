<?php

$mysqli=new mysqli('localhost','root','','job_data') or die (mysql_error($mysqli));

$resultset= $mysqli -> query("SELECT job_no from job")

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
</head>
<body>

<form id="form" action="process.php" method="POST">

<input type="hidden" name="id" value="<?php echo $id; ?>">
<div class="container">
<label style="font-size: 20px" > Select a Job </label>
<select id="job" name="New Job Number" >
<?php

while($rows = $resultset->fetch_assoc()){
    $job_no=$rows['job_no'];
    echo "<option value='$job_no'>$job_no</option>";

}

?>

    </select> 
    <button class="button" name="clear" onClick="clearform();">Clear Data</button>
    

<div class="containerbox" >
        <ul>
            <li> <div class="bottom">Job Details</div>
            <div class="grid-container">
  <div class="grid-item">
      <label >Booked By</label><input type="text" name="booked" id="booked" >
  </div>
  <div class="grid-item">
      <label >Accepted By</label> <input type="text" name="accepted" id="accepted">
  </div>
  <div class="grid-item">
      <label >POD/POL</label><input type="text" name="description" id="description">
  </div>
  <div class="grid-item">
      <label >Cargo Description</label><input type="text" name="pod" id="pod">
 </div>
  <div class="grid-item">
      <label >Booked Date</label><input type="date" name="date" id="date" >
    </div>
  <div class="grid-item">
      <label >Conatiner NO.</label><input type="text" name="container_no" id="container_no">
    </div>
  <div class="grid-item">
      <label >Job NO.</label><input type="text" name="job_no" id="job_no">
    </div>
</div>
 </li>
            <li> <div class="bottom">Remarks</div>
            <div class="grid-container">
            <div class="grid-item">
      <label >Remark</label> <textarea style="width:75%" name="remark" id="remark"></textarea>
  </div>
</div> 
            </li>
            <li> <div class="bottom">Booked Containers</div>
            <div class="grid-container">
  <div class="grid-item">
      <label >20</label><input type="text" name="container_20" id="container_20">
  </div>
  <div class="grid-item">
      <label >40</label> <input type="text" name="container_40"  id="container_40">
  </div>
  <div class="grid-item">
      <label >45HC</label><input type="text" name="container_45HC" id="container_45HC">
  </div>
  <div class="grid-item">
      <label >2RF</label><input type="text" name="container_2RF" id="container_2RF">
 </div>
  <div class="grid-item">
      <label >40RF</label><input type="text" name="container_40RF"  id="container_40RF">
    </div>
</div>
        
        
        
        </li>
            
        </ul>
      
    </div>
    <input type="submit" value="Add New" name="save" id="save"> 
    <button class="button2" value="Update" name="edit" >Update</button>
    <button class="button3" value="Delete" name="delete" >Delete</button>
   
</div>
</form>
</body>
</html>
<script>
 $(document).ready(function(){

$('#job').change(function(){

     $("#save").prop('disabled', true);
    var job_no = $(this).val();



    $.ajax({

      type:'POST',
   data:{job_no:job_no},
   url:'process.php',
   success:function(data){  
       var json=JSON.parse(data);
       $.each(json,function(){
        $("#booked").val(this.booked);
        $("#accepted").val(this.accepted);
        $("#description").val(this.description);
        $("#pod").val(this.pod);
        $("#date").val(this.date);
        $("#container_no").val(this.container_no);
        $("#job_no").val(this.job_no);
        $("#remark").val(this.remark);
        $("#container_20").val(this.container_20);
        $("#container_40").val(this.container_40);
        $("#container_45HC").val(this.container_45HC);
        $("#container_2RF").val(this.container_2RF);
        $("#container_40RF").val(this.container_40RF);
       })
       

   }

    });

});


 });

 function clearform()
{
    document.getElementById('form').reset();
    header('Location: index.php');
    exit();
}

 </script>