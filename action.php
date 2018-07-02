<?php
    session_start();

    require 'users.php'; // users class called
//php mailer file
    require 'PHPMailerAutoload.php';
    require 'credential.php';
    
    if(isset($_POST['action']) && $_POST['action'] == 'checkCookie'){
        if(isset($_COOKIE['email'], $_COOKIE['pass'])){
            $data = ['email' => $_COOKIE['email'] , 'pass' => base64_decode($_COOKIE['pass'])];
            echo json_encode($data);
        }
    }


    if(isset($_POST['action']) && $_POST['action'] == 'resetPass'){
            $email = filter_input(INPUT_POST,'remail',FILTER_VALIDATE_EMAIL);
                if(false == $email){
                    echo json_encode( ["status" => 0, "msg" => "Enter valid Email"] );
                    exit;
                } 
        $objUser = new Users();
        $objUser->setEmail($email);
        $userData = current($objUser->getUserByEmail());
        
        if(is_array($userData) && count($userData) > 0 ){
                $data['id'] = $userData['id'];
                $data['token'] = sha1($userData['email']);
                $data['expTime'] = date('d-m-Y h:i:s' , time() + (60*60*2));
                $urlToken = base64_encode(json_encode($data));
                
                $objUser->setId($data['id']);
                $objUser->setToken($data['token']);
                if($objUser->updateToken()){
                    $url = "http://".$_SERVER['SERVER_NAME'].'/user/reset.php&token='.$urlToken;
                    $html = '<div>You have requested a password request for your user accounnt at localhost. You can do this by clicking th buttuon below.'.$url.'<br><br><strong>Please note this link is valid for 2 hours </strong></div>';
                    
                        $mail = new PHPMailer;

        //                $mail->SMTPDebug = 4;                               // Enable verbose debug output

                        $mail->isSMTP();                                      // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                        $mail->SMTPAuth = true;                               // Enable SMTP authentication
                        $mail->Username = EMAIL;                 // SMTP username
                        $mail->Password = PASS;                           // SMTP password
                        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587;                                    // TCP port to connect to

                        $mail->setFrom(EMAIL, 'Goutam Reddy');
                        $mail->addAddress($objUser->getEmail());// Add a recipient
                                            // Name is optional
                        $mail->addReplyTo(EMAIL);
                       // $mail->addCC('cc@example.com');
                       // $mail->addBCC('bcc@example.com');
        //            print_r($_FILES['file']); exit;

                               // Add attachments
                        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                        $mail->isHTML(true);                                  // Set email format to HTML

                        $mail->Subject = 'Reset your password';
                        $mail->Body    = $html;
        //            

                        if(!$mail->send()) {
                           
                            echo json_encode( ["status" => 0, "msg" => "Message could not be sent.l"] );
                            
                            echo json_encode( ["status" => 0, "msg" =>'Mailer Error: ' . $mail->ErrorInfo] );
                        } else {
                           
                            
                            echo json_encode( ["status" => 1, "msg" => "Reset password link is send to your email"] );
                        }
                    
                }else{
                    echo json_encode( ["status" => 0, "msg" => "Failed to set token"] );
                }
        }else{
            echo json_encode( ["status" => 0, "msg" => "User is not found"] );
        }
    }
if(isset($_POST['action']) && $_POST['action'] == 'register'){
		$users = validateRegForm();
	
		$objUser = new Users();
		$objUser->setName($users['fname']);
		$objUser->setMobile($users['mobno']);
		$objUser->setEmail($users['uemail']);
		$objUser->setPass(md5($users['passwd']));
		$objUser->setActivated(0);
		$objUser->setToken(NULL);
		$objUser->setCreatedOn(date('Y-m-d'));
		

        $userData = current($objUser->getUserByEmail());
   
        if($userData['email'] == $users['uemail']){
            echo 'Email is already registered';
            exit;
        }

		if($objUser->save())
		{
			$lastId = $objUser->conn->lastInsertId();
			$token = sha1($lastId);
			$url = "http://".$_SERVER['SERVER_NAME'].'/user/verify.php?id='.$lastId.'&token='.$token;
			$html = '<div>Thanks for regstrering with localhost.please click this link to complete your registration:</br>'.$url.'</div>';
               

                $mail = new PHPMailer;

//                $mail->SMTPDebug = 4;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = EMAIL;                 // SMTP username
                $mail->Password = PASS;                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->setFrom(EMAIL, 'Goutam Reddy');
                $mail->addAddress($objUser->getEmail());// Add a recipient
                                    // Name is optional
                $mail->addReplyTo(EMAIL);
               // $mail->addCC('cc@example.com');
               // $mail->addBCC('bcc@example.com');
//            print_r($_FILES['file']); exit;
                
                       // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'Confirm your email';
                $mail->Body    = $html;
//            

                if(!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                   echo "Congratulation, Your Registration done on our site. Please confirm you email";
                }   
		}else{
			echo "failed to dave";
		}
		
	}

if(isset($_POST['action']) && $_POST['action'] == 'login'){
		$users = validateLoginForm();
		$objUser = new Users();
    
        $objUser->setEmail($users['email']);
		$objUser->setPass(md5($users['pwd']));
        $userData = current($objUser->getUserByEmail()); 
        $rememberMe = isset($_POST['remember-me']) ? 1 :0;
    
        if(is_array($userData) && count($userData) > 0){
            if($userData['pass'] == $objUser->getPass()){
                if($userData['activated'] == 1){
                    if($rememberMe == 1){
                        setcookie('email', $objUser->getEmail());
                         setcookie('pass', base64_encode($users['pwd']));
                        
                    }
                        $_SESSION['id'] = session_id();
                        $_SESSION['name'] = $userData['name'];
                        echo json_encode(["status" => 1,"msg" => "login successfull."]);
            
                }
                else{
                    echo json_encode(["status" => 0,"msg" => "Please activate you account to login."]);
                }
            }else{
            echo json_encode(["status" => 0,"msg" => "password is wrong."]);
        }
        }else{
            echo json_encode(["status" => 0,"msg" => "Email  is wrong."]);
        }
   
    
}


        function validateLoginForm(){
                $users['email'] = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
                if(false == $users['email']){
                    echo json_encode( ["status" => 0, "msg" => "Enter valid Email"] );
                    exit;
                }
                $users['pwd'] = filter_input(INPUT_POST, 'pwd',FILTER_SANITIZE_STRING);
                if(false == $users['pwd']){
                    echo json_encode(["status" => 0,"msg" => "Enter valid passord"]);
                    exit;
                }

            return $users;
        }
		
		function validateRegForm(){
			
		
		$users['fname'] = filter_input(INPUT_POST,'fname',FILTER_SANITIZE_STRING);
		if(false == $users['fname']){
			echo "Enter valid name";
			exit;
		}
		$users['mobno'] = filter_input(INPUT_POST,'mobno',FILTER_SANITIZE_NUMBER_INT);
		if(false == $users['mobno']){
			echo "Enter valid Mobile number";
			exit;
		}
		$users['uemail'] = filter_input(INPUT_POST,'uemail',FILTER_VALIDATE_EMAIL);
		if(false == $users['uemail']){
			echo "Enter valid Email";
			exit;
		}
		$users['passwd'] = filter_input(INPUT_POST,'passwd',FILTER_SANITIZE_STRING);
		if(false == $users['passwd']){
			echo "Enter valid passord";
			exit;
		}
		$users['cpasswd'] = filter_input(INPUT_POST,'cpasswd',FILTER_SANITIZE_STRING);
		if(false == $users['cpasswd']){
			echo "Enter valid confirm Password";
			exit;
		}
		if($users['passwd'] != $users['cpasswd'] ){
			echo "Password and confirm password not match";
			exit;
		}
		return $users;
	}










?>