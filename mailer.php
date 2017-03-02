<?php  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
		$phone = $_POST['phone'];
		$vehicle = $_POST['vt'];

       
        if ( empty($name) OR empty($message) OR empty($vehicle) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        
        $recipient = "hello@tourbigg.com";


        $subject = "New Registration : Tourbigg";

		$email_headers = "From: $name <$email>\r\n";
		$email_headers .= "Reply-To: $name <$email>\r\n";
		$email_headers .= "MIME-Version: 1.0\r\n";
		$email_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$email_content  = '<html><body style="background-color:#cccccc;padding: 35px inherit;">';
		$email_content .= '<div style="width:650px;margin:15px auto;background-color:#ffffff;box-shadow:0 -1px 10px #000000;padding:20px;font-size:14px;">';
		$email_content .= '<h1 style="padding:25px inherit 45px inherit;display:block;width:650px;text-align:center;margin-bottom: 50px;"><img src="http://tourbigg.com/logo.png" alt="logo"></h1>';
		$email_content .= '<div><span style="color:#000000;">Name:</span> <span style="color:#000000;font-style:italic;">'.$name.'</span></div>';
		$email_content .= '<div><span style="color:#000000;">Email:</span> <span style="color:#000000;font-style:italic;">'.$email.'</span></div>';
		$email_content .= '<div><span style="color:#000000;">Phone:</span> <span style="color:#000000;font-style:italic;">'.$phone.'</span></div>';
		$email_content .= '<div style="margin-top:75px;color:#000000;font-size: 18px;text-decoration:underline;">Message:</div>';
		$email_content .= '<div style="font-size:14px;line-height:25px;color:#000000;">'.$message.'</div>';
		$email_content .= '</body></html></div>';



        if (mail($recipient, $subject, $email_content, $email_headers)) {
           
            http_response_code(200);
			
			
			$headerRep = "From: TourBigg <no-reply@tourbigg.com>\r\n";
			$headerRep .= "Reply-To: <no-reply@tourbigg.com>\r\n";
			$headerRep .= "MIME-Version: 1.0\r\n";
			$headerRep .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$subjectRep =   "Registration - TourBigg";
			
			$messageRep  = '<html><body style="background-color:#cccccc;padding: 35px inherit;">';
			$messageRep .= '<div style="width:650px;margin:15px auto;background-color:#ffffff;box-shadow:0 -1px 10px #000000;padding:20px;font-size:14px;">';
			$messageRep .= '<h1 style="padding:25px inherit 45px inherit;display:block;width:650px;text-align:center;margin-bottom: 50px;"><img src="http://tourbigg.com/logo.png" alt="logo"></h1>';
			$messageRep .= '<div style="font-size:14px;line-height:25px;color:#000000;">';
			$messageRep .= 'You have successfully registered to tourbigg.com. We will get back to you shortly. If you have any further query then call us to the below number';
			$messageRep .= '<div style="margin-top:50px;line-height:16px;">';
			$messageRep .= '<div><span style="color:#000000;">Thanks!</span></div>';
			$messageRep .= '<div><span style="color:#000000;">Team Tourbigg</span><br><br></div>';
			$messageRep .= '<div><span style="color:#000000;">Email:</span> <span style="color:#000000;font-style:italic;">'.$recipient.'</span></div>';
			$messageRep .= '<div><span style="color:#000000;">Phone:</span> <span style="color:#000000;font-style:italic;">+9 4767070990</span></div>';
			$messageRep .= '<div><span style="color:#000000;">Website:</span> <span style="color:#000000;font-style:italic;">www.tourbigg.com</span></div>';
			$messageRep .= '<div><br><br><span style="color:#000000;">No 505/4, Kaduwela road, Malabe, Sri lanka</span></div>';
			$messageRep .= '</div></div>';
			$messageRep .= '</body></html></div>';
			
			mail($email, $subjectRep, $messageRep, $headerRep);
			
            echo "Thank You! You have successfully registered with us. We will get back to you shoortly";
        } else {
            
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't get this done now.";
        }

    } else {
        
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>
