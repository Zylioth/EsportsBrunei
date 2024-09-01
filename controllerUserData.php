<?php 
session_start();
require "app/database/connect.php";
$teamName = "";
$email = "";
$username = "";
$phone_number = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if($phone_number < 8 ) {
        $errors['phone_number'] = "Your Phone Number must have 7 digits!";
    }

    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        $errors['password'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    }

    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO users (username, email, phone_number, password, code, status)
                        values('$username', '$email', '$phone_number', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($conn, $insert_data);
        if($data_check){

            $swap_var = array(
                "{OTP_CODE}" => $code,
            );

            // main header (multipart mandatory)
            $eol = "\r\n";

        $headers = "From: FYP ESPORT BRUNEI" . $eol;
        $headers .= "MIME-Version: 1.0" . $eol;
        $headers = "From: FYP ESPORT BRUNEI \r\n";
        $headers = 'MIME-Version: 1.0' . "\r\n" .
           'Content-type: text/html; charset=iso-8859-1' . "\r\n" ;
            $subject = "Email Verification Code";
            // $image = "https://lh3.googleusercontent.com/ZKcH5iwg5_b50eYPjTIw6kck8VoNFbAjEsawHgsmyMEquoypSynOXKXecfzvcYCJimReCcZ1dxD_t7oo3zG7pN77NJOQxSr48ZxBWKv4QN80m-wSqYRF3Bj37T-i6dYo9h3pudtJxQCYWl2bxx1l6QzpwLy0VnHPCnIKwqQXi22SlauINPQidmPNVQ0Ph_BtEmZwYAbUXQBjUP-zyC7yr2ML4FsxWH5RFH420rgVajozJf7fWjgMLbzSOcIrxssurZWFN-16jjgZ_giXpZyRFcnkVgUxVqXmDX6_76SeBvRyGyEW-UbScTdTakg_B0MeS73vtuKWhOThSM8wBuVzNQZ8bbF65IPlllikU25sYj9-cr70_8Q0sLY4zTn-ktbvcWM8mPre2yqqGo0sIsgS2phx0yh32Bb7w2xyTKJHklQmtawuIsmcq8NWjULCUyF7v55lrSsTfbiGYJKtLRyLuL2_dAchm27nhZpunkDL8_mji_rUxaXslT_efX7YrUxoNBFLnmO5WptatPMamn9C8qj1cZ2NJwxF9UtjJbwsGKHBMM216hmojZLlkbeib7krtbQR92ubdw1Ug6xV2mQnCyfXaiW-7H_8OCI2iAT7530vW6ZuL05SWM5Ex0P6zojV9GD49xG-X9IpPy3CKMnycYmkTOpVLH-eerzIkrC_NQB9E3rgTmkgcRptZnkZb5pocOpn4ydwYw_dVreqlWJLvVk=w513-h301-no?authuser=0" ;
            // $message = "Your verification code is $code" ;
            $message =  file_get_contents('./emailtemplate/emailotp.php');;
            $sender = "From: FYP ESPORT BRUNEI";

            // search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
	foreach (array_keys($swap_var) as $key){
		if (strlen($key) > 2 && trim($swap_var[$key]) != '')
			$message = str_replace($key, $swap_var[$key], $message);
	}
            
            if(mail($email, $subject, $message, $headers)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE users SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                $_SESSION['name'] = $username;
                $_SESSION['email'] = $email;
                header('location: login-user.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    // if user click login button
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $check_email = "SELECT * FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if ($fetch['blocked'] == 1) {
                $errors['email'] = "Your Account has been block";
            } else {
                if(password_verify($password, $fetch_pass)){
                    $_SESSION['email'] = $email;
                    $status = $fetch['status'];
                    if($status == 'verified'){
                      $_SESSION['admin'] = $fetch['admin'];
                      $_SESSION['username'] = $fetch['username'];
                      $_SESSION['id'] = $fetch['id'];
                      $_SESSION['email'] = $fetch['email'];
                      $_SESSION['bio'] = $fetch['bio'];
                      $_SESSION['password'] = $fetch['password'];
                      header('location: index.php');

                    }else{
                        $info = "It's look like you haven't still verify your email - $email";
                        $_SESSION['info'] = $info;
                        header('location: user-otp.php');
                    }
                }else{
                    $errors['email'] = "Incorrect email or password!";
                } 
            }
            
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE users SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            if($run_query){

                $swap_var = array(
                    "{OTP_CODE}" => $code,
                );
    
                // main header (multipart mandatory)
                $eol = "\r\n";
    
            $headers = "From: FYP ESPORT BRUNEI" . $eol;
            $headers .= "MIME-Version: 1.0" . $eol;
            $headers = "From: FYP ESPORT BRUNEI \r\n";
            $headers = 'MIME-Version: 1.0' . "\r\n" .
               'Content-type: text/html; charset=iso-8859-1' . "\r\n" ;
               

                $subject = "Password Reset Code";
                // $message = "Your password reset code is $code";
                $message = file_get_contents('./emailtemplate/ForgotPass.php');;
                $sender = "From: FYP ESPORT BRUNEI";

                // search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
	foreach (array_keys($swap_var) as $key){
		if (strlen($key) > 2 && trim($swap_var[$key]) != '')
			$message = str_replace($key, $swap_var[$key], $message);
	}

                if(mail($email, $subject, $message, $headers)){
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }
         if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
            $errors['password'] = 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }

    // this function is to get the user details by their id
    function getUserById($id)
	{
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);
		$_SESSION['userid2'] = $user['id'];
		// returns user in an array format: 
		// ['id'=>1 'username' => 'Awa', 'email'=>'a@a.com', 'password'=> 'mypass']
		return $user; 
	}
?>