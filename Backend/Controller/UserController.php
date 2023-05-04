<?php

     require_once '../Model/User.php';
     require_once '../Model/Token.php';
     require_once '../Config/EmailSender.php';
     // require_once '/var/www/customers/vh-63381/web/home/Backend/Model/User.php';
    // require_once dirname(DIR).'../Model/User.php';
    // require_once __DIR__.'../Model/User.php';
    // require_once 'Backend/Model/User.php';
    // require_once __DIR__.'Backend/Model/User.php';
    // require_once dirname(DIR).'Backend/Model/User.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$data = json_decode(file_get_contents("php://input"));

if($data->function == "registration"){
    if(!empty($data->email) && !empty($data->password) && !empty($data->firstname) && !empty($data->lastname) && !empty($data->phone) && !empty($data->img)){    
        if(User::addNewUser($data->email, $data->password, $data->firstname, $data->lastname, $data->phone, $data->img)){         
            http_response_code(201);         
            echo json_encode(array("message" => "User created."));
        }
        else{         
            http_response_code(503);        
            echo json_encode(array("message" => "Unable to create user. Password is not long enough, or email is already taken!"));
        }
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "login"){
    if(!empty($data->email) && !empty($data->password)){    
        $ered = User::login($data->email, $data->password);
        session_start();
        $_SESSION['uid'] = $ered['id'];
        $_SESSION['created'] = $ered['time'];
        $ered['sessionId'] = session_id();
        http_response_code(201);         
        echo json_encode(array("user" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "logout"){
    if(!empty($data->id)){    
        if(User::logout($data->id)){
            http_response_code(201);         
            echo json_encode(array("message" => "User logged out."));
            session_destroy();
        }
        else{         
            http_response_code(503);        
            echo json_encode(array("message" => "Unable to log out. userid: ".$data->id));
        }
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "searchByEmail"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->email)){    
            $ered = User::searchByEmail($data->email);
            http_response_code(201);         
            echo json_encode(array("user" => $ered)); 
        }
        else{    
            http_response_code(400);    
            echo json_encode(array("message" => "Please fill every required input field!"));
        }
    }
    else{
        http_response_code(403);         
        echo json_encode(array("message" => "Forbidden!"));
    }
}

if($data->function == "updateUser"){
     session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->email) && !empty($data->firstname) && !empty($data->lastname) && !empty($data->phone) && !empty($data->img)){    
            if(User::updateUser($_SESSION['uid'],$data->email,$data->firstname, $data->lastname, $data->phone, $data->img)){         
                http_response_code(201);         
                echo json_encode(array("message" => "User updated."));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to update user."));
            }
        }
        else{    
            http_response_code(400);    
            echo json_encode(array("message" => "Please fill every required input field!"));
        }
    }
    else{
        http_response_code(403);         
        echo json_encode(array("message" => "Forbidden!"));
    }
}

if($data->function == "deleteUser"){
     session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            if(User::deleteUser($data->id)){         
                http_response_code(201);         
                echo json_encode(array("message" => "User deleted."));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to delete user."));
            }
        }
        else{    
            http_response_code(400);    
            echo json_encode(array("message" => "Please fill every required input field!"));
        }
    }
    else{
        http_response_code(403);         
        echo json_encode(array("message" => "Forbidden!"));
    }
}

if($data->function == "forgotPassword"){
        if(!empty($data->email)){    
            $token = Token::addToken($data->email);
            if(EmailSender::sendNewPasswordEmail($data->email, $token)){         
            //if(Project::addProject($data->name, $data->description, $data->startDate, 11, $data->priority, $data->extraTime)){         
                http_response_code(201);         
                echo json_encode(array("message" => "Email succesfully sent!"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to create project!"));
            }
        }
        else{    
            http_response_code(400);    
            echo json_encode(array("message" => "Please fill every required input field!"));
        }
}

if($data->function == "resetPassword"){
        if(!empty($data->pw) && !empty($data->email) && !empty($data->token)){    
            
            if(Token::resetPassword($data->pw, $data->email, $data->token)){         
            //if(Project::addProject($data->name, $data->description, $data->startDate, 11, $data->priority, $data->extraTime)){         
                http_response_code(201);         
                echo json_encode(array("message" => "Successfully set new password!"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to set password!"));
            }
        }
        else{    
            http_response_code(400);    
            echo json_encode(array("message" => "Please fill every required input field!"));
        }
}
