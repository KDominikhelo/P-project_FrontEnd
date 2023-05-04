<?php

     require_once '../Model/Project.php';
     require_once '../Model/Attachment.php';
     // require_once '/var/www/customers/vh-63381/web/home/Backend/Model/User.php';
    ;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$data = json_decode(file_get_contents("php://input"));

if($data->function == "createProject"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->name) && !empty($data->description) && !empty($data->startDate) && !empty($data->priority) && !empty($data->extraTime) & !empty($data->img)){    
            $ered = Project::addProject($data->name, $data->description, $data->startDate, $_SESSION['uid'], $data->priority, $data->extraTime, $data->img);
            if($ered != false){         
            //if(Project::addProject($data->name, $data->description, $data->startDate, 11, $data->priority, $data->extraTime)){         
                http_response_code(201);         
                echo json_encode(array("message" => $ered));
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
    else{
        http_response_code(403);         
        echo json_encode(array("message" => "Forbidden!"));
    }
}

if($data->function == "getProjectById"){
    if(!empty($data->id)){    
        $ered = Project::getProjectById($data->id);
        http_response_code(201);         
        echo json_encode(array("Project" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "getUserFromComment"){
    if(!empty($data->id)){    
        $ered = Project::getUserFromCommentTag($data->id);
        http_response_code(201);         
        echo json_encode(array("User" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "getUsers"){
    if(!empty($data->id)){    
        $ered = Project::getUsers($data->id);
        http_response_code(201);         
        echo json_encode(array("User" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "getProjectByUser"){
    session_start();
    if(isset($_SESSION['uid'])){  
            $ered = Project::getProjectByUser($_SESSION['uid']);
            http_response_code(201);         
            echo json_encode(array("Result" => $ered));
    }
    else{
        http_response_code(403);         
        echo json_encode(array("message" => "Forbidden!"));
    }
}

if($data->function == "getUserByProjectId"){
    if(!empty($data->id)){    
        $ered = Project::getUserByProjectId($data->id);
        http_response_code(201);         
        echo json_encode(array("Result" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "updateProject"){
    session_start();
//    if(isset($_SESSION['uid'])){
        if(!empty($data->name) && !empty($data->description) && !empty($data->startDate) && !empty($data->priority) && !empty($data->extraTime) && !empty($data->img) && !empty($data->name)){    
            $ered = Project::updateProject($data->id,$data->name,$data->img, $data->description, $data->priority, $data->startDate, $data->extraTime, $_SESSION['uid']);
            //$ered = Project::updateProject($data->id,$data->name,$data->img, $data->description, $data->priority, "2023-04-01 12:00:00", $data->extraTime, 33);
            if($ered != false){         
            //if(Project::addProject($data->name, $data->description, $data->startDate, 11, $data->priority, $data->extraTime)){         
                http_response_code(201);         
                echo json_encode(array("message" => $ered));
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
//    }
//    else{
//        http_response_code(403);         
//        echo json_encode(array("message" => "Forbidden!"));
//    }
}

if($data->function == "deleteProject"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            if(Project::deleteProject($data->id, $_SESSION['uid'])){
                http_response_code(201);         
                echo json_encode(array("Result" => "Project deleted"));
            }
            else{
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to delete project!"));
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

if($data->function == "restoreProject"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->project)){    
            if(Project::restoreProject($data->project, $_SESSION['uid'])){ 
               http_response_code(201);         
                echo json_encode(array("message" => "Project restored"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "You dont have permission to restore it"));
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

if($data->function == "getArchivedProjectByUser"){
    session_start();
    if(isset($_SESSION['uid'])){  
            $ered = Project::getArchivedProjectByUser($_SESSION['uid']);
            http_response_code(201);         
            echo json_encode(array("Result" => $ered));
    }
    else{
        http_response_code(403);         
        echo json_encode(array("message" => "Forbidden!"));
    }
}

if($data->function == "addUserToProject"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->project) && !empty($data->user) && !empty($data->role)){    

            if(Project::addUserToProject($data->project, $data->user, $_SESSION['uid'], $data->role, $data->editor, $data->reviewer)){         
               http_response_code(201);         
                echo json_encode(array("message" => "User added."));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to add user!"));
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

