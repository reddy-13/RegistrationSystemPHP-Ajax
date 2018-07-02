<?php
 session_start();
    if($_SESSION['id'] != session_id()){
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <script src="js/jquery-3.3.1.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h2 class="text-center">Welcome to <strong>Mysite</strong> </h2>
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <div class="col-md-10">Hello, <strong> <?php echo $_SESSION['name']; ?></strong> </div>
                <div class="col-md-2"><a href='logout.php'>logout</a> </div>
            </div>
        </div>
    </div>
</body>
</html>