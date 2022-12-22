<?php

define("REQUEST_FIELD_ERROR","this field is required");
$errors=[];

$username="";
$email="";
$phone="";
$password="";
$repeat_password="";
$cv_url="";

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $username=post_data("username");
    $email=post_data("email");
    $phone=post_data("phone");
    $password=post_data("password");
    $repeat_password=post_data("password-confirm");
    $cv_url=post_data("cv_url");

    if(!$username){
        $errors['username'] = REQUEST_FIELD_ERROR;
    } elseif(strlen($username) < 6 || strlen($username) > 16) {
        $errors["username"] = "username must be between 6 - 16 character";
    }
    
    if(!$email){
        $errors['email'] = REQUEST_FIELD_ERROR; 
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "this field must be valid email address";
    } 

    if(!$phone){
        $errors['phone'] = REQUEST_FIELD_ERROR;
    }elseif (strlen((string)$phone) !=11) {
        $errors['phone'] = "the phone number must be 11 digit";
    }

    if(!$password){
        $errors['password'] = REQUEST_FIELD_ERROR;
    }

    if(!$repeat_password){
        $errors['password-confirm'] = REQUEST_FIELD_ERROR;
    }

    if($password && $repeat_password && strcmp($password,$repeat_password) !==0 ){
        $errors['password-confirm'] = "this field must match Password field";

    }

    if(!$cv_url){
        $errors['cv_url'] = REQUEST_FIELD_ERROR;}
    elseif ( ! filter_var($cv_url, FILTER_VALIDATE_URL)){
        $errors['cv_url'] = "this field must be valid url";
    }
}

function post_data($field){
    if(!isset($_POST[$field])){
        return false;
    }
    return htmlspecialchars(stripslashes($_POST[$field]));
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registration Form</title>
        <link rel="stylesheet" href="Css/bootstrap.min.css" />
        <link rel="stylesheet" href="Css/font-awesome.min.css" />
        <link rel="stylesheet" href="Css/contact.css" />
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Registration Form</h1>
            <form class="contact-form" action="save.php" method="POST">
                
                <i class="fa fa-user"></i>
                <lable>Username</lable>
                <input class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" 
                    type="text" name="username" value="<?php echo $username;?>" 
                    placeholder="type your name" />
                <div class="invalid-feedback" style="color:red">
                    <?php echo isset($errors["username"]) ? $errors["username"] : '';?>
                </div>

                <i class="fa fa-envelope"></i>
                <lable>Email</lable>
                <input class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" 
                        type="email" name="email" value="<?php echo $email;?>" 
                        placeholder="example@gmail.com" />
                <div class="invalid-feedback" style="color:red">
                    <?php echo isset($errors["email"]) ? $errors["email"] : '' ?>
                </div>
                
                <i class="fa fa-phone"></i>
                <lable>Phone</lable>
                <input class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : '';?>" 
                type="text" name="phone" value="<?php echo $phone;?>" 
                placeholder="type your cellphone" />
                <div class="invalid-feedback" style="color:red">
                    <?php echo isset($errors['phone']) ? $errors["phone"] : '';?>
                </div>

                <i class="fa fa-key"></i>
                <lable> Password </lable>
                <input class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" 
                type="password" name="password" value="<?php echo $password;?>" 
                placeholder="type your password" />
                <div class="invalid-feedback" style="color:red">
                    <?php echo isset($errors["password"]) ? $errors["password"] : ''; ?>
                </div>


                <i class="fa fa-check"></i>
                <lable> Password Confirm </lable>
                <input class="form-control <?php echo isset($errors['password-confirm']) ? 'is-invalid' : ''; ?>" 
                type="password" name="password-confirm" value="<?php echo $repeat_password;?>" 
                placeholder="repeat your password" />
                <div class="invalid-feedback" style="color:red">
                    <?php echo isset($errors['password-confirm']) ? $errors['password-confirm'] : '';?>
                </div>

                <i class="fa fa-link"></i>
                <label>your Cv Link</label>
                <input type="url" 
                    class="form-control <?php echo isset($errors['cv_url']) ? 'is-invalid' : '' ?>" 
                    name="cv_url" 
                    placeholder="http://www.example.com/my-cv" value = "<?php echo $cv_url?>">
                    <div class='invalid-feedback' style='color:red'>
                        <?php echo isset($errors['cv_url']) ? $errors['cv_url']: '' ?>
                    </div>

                <button class="btn btn-success">submit</button>

                <div class="panel <?php echo empty($errors) && $_SERVER["REQUEST_METHOD"]==="POST" ? 'pane2' : '' ?>">
                    <?php
                         if(empty($errors) && $_SERVER["REQUEST_METHOD"]==="POST"){
                            echo "every thing is ok!";
                        }
                    ?>
                </div>

            </form>
        </div>
        <script src="JS/jquery-1.12.4.min.js"></script>
        <script src="JS/bootstrap.min.js"></script>
    </body>
</html>                   