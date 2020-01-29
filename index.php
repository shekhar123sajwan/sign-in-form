<?php
require_once('Action.php');
$action = new Action();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $result = $action->saveAction($_POST);
}

if($_SERVER['REQUEST_METHOD'] == 'GET') { 
  $result = $action->editAction($_GET);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Reg form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 </head>
<body> 
<div class="container">
  <h2>Registration form</h2>
  <form method="POST" action="index.php" enctype="multipart/form-data" >
  <?php if(isset($result['errors']) && !empty($result['errors'])) { ?>
  <?php foreach ($result['errors'] as $error) { ?>
     <span class="text text-danger"><?php echo $error; ?></span><br>
  <?php } } ?>
  <?php if(isset($result['success']) && !empty($result['success'])) { ?> 
     <span class="text text-success"><?php echo result['success']; ?></span><br>
  <?php }  ?>
  <input type="hidden" name="csrf" value="<?php echo md5(rand()); ?>" ?>

  <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>


    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>

    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control" id="file"  name="image">
    </div>

    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="hobbies[]" value="dance"> dance</label>
      <label><input type="checkbox" name="hobbies[]" value="yoga"> Yoga</label> 
      <label><input type="checkbox" name="hobbies[]" value="gym"> Gym</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>
