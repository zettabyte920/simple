<?php
date_default_timezone_set('Africa/Tunis');
include 'dbConfig.php';

/////////////////////////////////add new user to database///////////////////////////////////////////////
function newuser($uid, $student, $class, $email, $firstname, $lastname, $token){
	global $conn;
	$id = $uid;
	$created = date("Y-m-d h:i:s",time());
	$timestamp = time();
	$picture = "https://graph.facebook.com/$id/picture?type=large&width=500&height=500";
try {
    $stmt = $conn->prepare("INSERT INTO user (uid, student, class, picture, email, firstname, lastname, token, created, timestamp) 
    VALUES (:uid, :student, :class, :picture, :email, :firstname, :lastname, :token, :created, :timestamp)");
    //$sql = "INSERT INTO user (username, password, email, birthday, status, created)
    //VALUES ('$username','$password','$email', '$birthday', '$status', '$created')";
    // use exec() because no results are returned
	
    $stmt->bindParam(':uid', $uid);
	$stmt->bindParam(':student', $student);
	$stmt->bindParam(':class', $class);
	$stmt->bindParam(':email', $email);
    $stmt->bindParam(':picture', $picture);
	$stmt->bindParam(':firstname', $firstname);
	$stmt->bindParam(':lastname', $lastname);
	$stmt->bindParam(':token', $token);
	$stmt->bindParam(':created', $created);
	$stmt->bindParam(':timestamp', $timestamp);
	
	function uidExists($uid) {
	global $conn;
    $stmt = $conn->prepare("SELECT 1 FROM user WHERE uid=?");
    $stmt->execute([$uid]); 
    return $stmt->fetchColumn();
	}	

if (uidExists($uid)) {
	$stmt = $conn->prepare("UPDATE user SET picture=:picture, email=:email, token=:token, timestamp=:timestamp WHERE uid=:uid");
	$stmt->bindParam(':picture', $picture);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':token', $token);
	$stmt->bindParam(':timestamp', $timestamp);
    $stmt->bindParam(':uid', $uid);
	$stmt->execute();
    $data['message'] = "data updated";
	echo json_encode($data);
	$_SESSION['uid'] = $uid;
	$conn = null;
	return false;
}

	// insert a row

    $stmt->execute();
    $data['message'] = "You have successfully registered";
	$data['success'] = "yes";
	$_SESSION['uid'] = $uid;
	
    } catch(PDOException $e)
    {
	$data['message'] = "Cannot create account";
	$data['success'] = "no";
	$data['reason'] = "Database error";
	echo "Connection failed: " . $e->getMessage();
	$conn = null;
    }
	echo json_encode($data);
    $conn = null;	
}
///////////////////////////////change timestamp to actual date ago/////////////////
	
?>