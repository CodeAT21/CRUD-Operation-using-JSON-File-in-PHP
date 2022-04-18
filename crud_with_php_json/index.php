<?php
session_start();
// Retrieve session data
$sessionData = !empty($_SESSION['sessionData'])?$_SESSION['sessionData']:'';
// Include and initialize JSON class
require_once 'Json.class.php';
$db = new Json();
// Fetch the member's data
$members = $db->getRows();
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
        <div class="col-md-12 head">
            <h5>Members</h5>
            <!-- Add link -->
            <div class="float-right">
                <a href="addEdit.php" class="btn btn-success"> New Member</a>
            </div>
        </div>
        
        <!-- List the users -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userData">
                <?php if(!empty($members)){ $count = 0; foreach($members as $row){ $count++; ?>
                <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['country']; ?></td>
                    <td>
                        <a href="addEdit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">edit</a>
                        <a href="userAction.php?action_type=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">delete</a>
                    </td>
                </tr>
                <?php } }else{ ?>
                <tr><td colspan="6">No member(s) found...</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>