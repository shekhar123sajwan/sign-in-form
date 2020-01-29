<?php require_once('Action.php'); ?>
<?php $action = new Action();?>
<?php $users = $action->getUsers(); ?>
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
  <h2>Listing Users</h2>
  <div class="container"> 
      <div class="users-wrapper">
      <?php if ($users->num_rows > 0) {  
             while($user = $users->fetch_assoc()) { ?>
               <div class="user">
                     <span> <?php echo $user['name'] ; ?></span>
                     <span><?php echo $user['email']; ?></span>
                     <a href='edit/?user=<?php echo $user['id']; ?>'>Edit</a>
              </div>  
            <?php }
            } ?>  
      </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>
