<?php require_once('header.php'); ?>

<?php admin_check(); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM tbl_group WHERE group_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<?php
	$statement = $pdo->prepare("DELETE FROM tbl_user_group WHERE group_id=?");
	$statement->execute(array($_REQUEST['id']));

	$statement = $pdo->prepare("DELETE FROM tbl_mail_group_all WHERE group_id=?");
	$statement->execute(array($_REQUEST['id']));

	$statement = $pdo->prepare("DELETE FROM tbl_item_group WHERE group_id=?");
	$statement->execute(array($_REQUEST['id']));
	
	$statement = $pdo->prepare("DELETE FROM tbl_group WHERE group_id=?");
	$statement->execute(array($_REQUEST['id']));

	

	header('location: group.php');
?>