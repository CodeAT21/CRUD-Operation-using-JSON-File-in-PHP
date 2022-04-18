<?php
session_start();
// Retrieve session data
$sessionData = !empty($_SESSION['sessionData'])?$_SESSION['sessionData']:'';
// Get member data
$memberData = $userData = array();
if(!empty($_GET['id'])){
	// Include and initialize JSON class
	include 'Json.class.php';
	$db = new Json();	
	// Fetch the member data
	$memberData = $db->getSingle($_GET['id']);
}
$userData = !empty($sessionData['userData'])?$sessionData['userData']:$memberData;
unset($_SESSION['sessionData']['userData']);
$actionLabel = !empty($_GET['id'])?'Edit':'Add';
// Get status message from session
if(!empty($sessionData['status']['msg'])){
    $statusMsg = $sessionData['status']['msg'];
    $statusMsgType = $sessionData['status']['type'];
    unset($_SESSION['sessionData']['status']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP CRUD with JSON by CodeAT21</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="container">
	<h1>PHP CRUD with JSON</h1>   
    <!-- Display status message -->
    <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
    <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $statusMsg; ?></div>
    </div>
    <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
    </div>
    <?php } ?>
    
    <div class="row">
		<div class="col-md-12">
			<h2><?php echo $actionLabel; ?> Member</h2>
		</div>
        <div class="col-md-6">
             <form method="post" action="userAction.php">
				<div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php echo !empty($userData['name'])?$userData['name']:''; ?>" required="">
                </div>
				<div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" value="<?php echo !empty($userData['email'])?$userData['email']:''; ?>" required="">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter contact no" value="<?php echo !empty($userData['phone'])?$userData['phone']:''; ?>" required="">
                </div>
                <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" name="country" placeholder="Enter country name" value="<?php echo !empty($userData['country'])?$userData['country']:''; ?>" required="">
                </div>
                
                <a href="index.php" class="btn btn-secondary">Back</a>
                <input type="hidden" name="id" value="<?php echo !empty($memberData['id'])?$memberData['id']:''; ?>">
                <input type="submit" name="userSubmit" class="btn btn-success" value="Submit">
            </form>
        </div>
    </div>
</div>
</body>
</html>