<?php
    include_once 'db_connection.php';


    if( isset( $_POST['submit'] ) ){

        if( !empty( $_POST['firstname'] ) 
            && !empty( $_POST['lastname'] ) 
            && !empty( $_POST['city'] ) 
            && !empty( $_POST['contacts'] ) 
            && !empty( $_POST['email'] ) 
            && !empty( $_POST['comment'] ) ) {

            // form validation
            $firstname = test_input( $_POST['firstname'] );
            $lastname = test_input( $_POST['lastname'] );
            $city = test_input( $_POST['city'] );
            $contacts = test_input( $_POST['contacts'] );
            $email = test_input( $_POST['email'] );
            $comment = test_input( $_POST['comment'] );
            $submit = test_input( $_POST['submit'] );

            $sql = "INSERT INTO signups (Firstname, Lastname, City, Contacts, Email, Comments)
                    VALUES ('$firstname','$lastname','$city','$contacts','$email', '$comment')";

            $run = mysqli_query($conn, $sql) or die();
            
            /* Confirmation email */
            $subject = "Registered";            
            // Settings for HTML mail
            $headers = 'MIME-Version: 1.0' ."\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            // Email headers
            $headers .= "From: lobola@planeteye.co";
            //HTML message
            $message = '<html><body>';
            $message .= '<p style="color:#0492c2; font-size:28px; font-weight:bold;">Hi '.$firstname.',</p>';
            $message .= '<p style="color:#505050; font-size:18px;">Thanks for registering to purchase Lobola<sup>TM</sup>. We will update you on release!</p>';
            $message .= '<br><p>Kind Regards,</p>';
            $message .= '<p>Lobola Team</p>';
            $message .= '<img src="https://planeteye.co/lobola/logo.png" width="150" height="75" alt="logo"/>';
            $message .= '<p><a href="https://planeteye.co/lobola">www.planeteye.co/lobola</a></p>';
            $message .= '</body></html>';

            mail($email,$subject,$message,$headers);

            if( $run ) {
                // echo "Form submitted successfully";
                header("Location: ../submitted.html?registered=success");

            } else{
                // echo "Form not submitted";
                header("Location: ../error.html");
            }

        } else{
            echo "all fields required";
        }
    
    }

    $conn->close();
    die();

    // test function for form validation
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        // $data = mysqli_real_escape_string($data);

        return $data;
      }
?> 