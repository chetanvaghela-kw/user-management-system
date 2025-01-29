<?php
/**
 * Header template for User Management System
 *
 * This file contains the header section of the HTML document,
 * including the navigation menu for the User Management System.
 *
 * @package UserManagementSystem
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Management System</title>
	<link href="./includes/assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="./includes/assets/css/index.css" rel="stylesheet" />
</head>
<body>
		<nav class="navbar navbar-dark bg-mynav">
			<div class="container-fluid">   
				<?php echo '<a href="/cv-user-management/" class="navbar-brand">Home</a>'; ?>
				<?php echo '<a href="?route=add_user" class="navbar-brand">Add User</a>'; ?>
			</div>
		</nav>
		<div class="container">
