<?php

     require_once '../Model/Team.php';
     require_once '../Model/Role.php';
     require_once '../Model/User_X_team.php';
     // require_once '/var/www/customers/vh-63381/web/home/Backend/Model/User.php';
    ;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$data = json_decode(file_get_contents("php://input"));

if($data->function == "createTeam"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->name) && !empty($data->img)){    
            if(Team::createTeam($data->name, $data->img, $_SESSION['uid'])){ 
               http_response_code(201);         
                echo json_encode(array("message" => "Team created"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to create Team!"));
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

if($data->function == "updateTeam"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->name) && !empty($data->img) && !empty($data->id)){    
            if(Team::updateTeam($data->name, $data->img, $_SESSION['uid'],$data->id)){ 
               http_response_code(201);         
                echo json_encode(array("message" => "Team updated"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to update Team!"));
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

if($data->function == "deleteTeam"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            if(Team::deleteTeam($_SESSION['uid'],$data->id)){ 
               http_response_code(201);         
                echo json_encode(array("message" => "Team deleted"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to delete Team!"));
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

if($data->function == "addTeamMember"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->user) && !empty($data->role) && !empty($data->team) && !empty($data->editor)){    
            if(User_X_team::addToTeam($data->user, $data->role, $data->team, $data->editor)){ 
               http_response_code(201);         
                echo json_encode(array("message" => "User added"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to add User!"));
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

if($data->function == "updateTeamMember"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->user) && !empty($data->role) && !empty($data->team) && !empty($data->editor)){    
            if(User_X_team::updateTeamMember($data->user, $data->role, $data->team, $data->editor,$_SESSION['uid'])){ 
               http_response_code(201);         
                echo json_encode(array("message" => "User updated"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to update User!"));
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

if($data->function == "deleteTeamMember"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id) && !empty($data->team)){    
            if(User_X_team::deleteTeam($data->team, $_SESSION['uid'], $data->id)){ 
               http_response_code(201);         
                echo json_encode(array("message" => "User deleted"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to delete User!"));
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

if($data->function == "getUserTeams"){
    session_start();
    if(isset($_SESSION['uid'])){   
        $ered = Team::getUserTeams($_SESSION['uid']);
        http_response_code(201);         
        echo json_encode(array("Result" => $ered));
    }
    else{
        http_response_code(403);         
        echo json_encode(array("message" => "Forbidden!"));
    }
}

if($data->function == "getTeam"){
//    session_start();
//    if(isset($_SESSION['uid'])){ 
        if(!empty($data->id)){  
            $ered = Team::getTeam($data->id);
            http_response_code(201);         
            echo json_encode(array("Result" => $ered));
        }
        else{
            http_response_code(400);    
            echo json_encode(array("message" => "Please fill every required input field!"));
        }
//    }
//    else{
//        http_response_code(403);         
//        echo json_encode(array("message" => "Forbidden!"));
//    }
}

if($data->function == "getRole"){
//    session_start();
//    if(isset($_SESSION['uid'])){  
        $ered = Role::getRole();
        http_response_code(201);         
        echo json_encode(array("Result" => $ered));
//    }
//    else{
//        http_response_code(403);         
//        echo json_encode(array("message" => "Forbidden!"));
//    }
}

if($data->function == "getTeamMembers"){
//    session_start();
//    if(isset($_SESSION['uid'])){ 
        if(!empty($data->id)){  
            $ered = Team::getTeamMembers($data->id);
            http_response_code(201);         
            echo json_encode(array("Result" => $ered));
        }
        else{
            http_response_code(400);    
            echo json_encode(array("message" => "Please fill every required input field!"));
        }
//    }
//    else{
//        http_response_code(403);         
//        echo json_encode(array("message" => "Forbidden!"));
//    }
}