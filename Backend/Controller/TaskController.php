<?php

     require_once '../Model/Task.php';
     require_once '../Model/Milestone.php';
     require_once '../Model/Attachment.php';
     require_once '../Model/User_X_Mention.php';
     // require_once '/var/www/customers/vh-63381/web/home/Backend/Model/User.php';
    ;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



$data = json_decode(file_get_contents("php://input"));

if($data->function == "createTask"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->projectId) && !empty($data->title) && !empty($data->userId)){    
            $ered =  Task::addTask($data->projectId, $data->title, $data->userId);
            if($ered != false){ 
               http_response_code(201);         
                echo json_encode(array("message" => $ered));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to create Task!"));
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

if($data->function == "fillTask"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id) && !empty($data->content) && !empty($data->devTime) && !empty($data->reviewTime)
               && !empty($data->priority) && !empty($data->deadline)
               && !empty($data->devId) && !empty($data->reviewId)){    

            if(Task::fillTask($data->id, $data->content, $data->devTime, $data->reviewTime, $data->priority, $data->deadline, $data->devId, $data->reviewId)){         
               http_response_code(201);         
                echo json_encode(array("message" => "Task updated."));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to update task!"));
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

if($data->function == "getTaskChecklist"){
    if(!empty($data->id)){    
        $ered = Task::getTaskChecklist($data->id);
        http_response_code(201);         
        echo json_encode(array("checklist" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "getTaskMilestone"){
    if(!empty($data->id)){    
        $ered = Task::getTaskMilestone($data->id);
        http_response_code(201);         
        echo json_encode(array("milestone" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "getTaskAttachment"){
    if(!empty($data->id)){    
        $ered = Task::getTaskAttachment($data->id);
        http_response_code(201);         
        echo json_encode(array("attachment" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "getTaskComment"){
    if(!empty($data->id)){    
        $ered = Task::getTaskComment($data->id);
        http_response_code(201);         
        echo json_encode(array("comment" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "getTaskByProjectId"){
    if(!empty($data->id)){    
        $ered = Task::getTaskByProjectId($data->id);
        http_response_code(201);         
        echo json_encode(array("Result" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "getTaskById"){
    if(!empty($data->id)){    
        $ered = Task::getTaskById($data->id);
        http_response_code(201);         
        echo json_encode(array("Result" => $ered));
        
    }
    else{    
        http_response_code(400);    
        echo json_encode(array("message" => "Please fill every required input field!"));
    }
}

if($data->function == "deleteTask"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            if(Task::deleteTask($_SESSION['uid'],$data->id)){ 
               http_response_code(201);         
                echo json_encode(array("message" => "Task deleted"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "You have no permission to delete"));
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

if($data->function == "moveTask"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id) && !empty($data->column)){    
            if(Task::moveTask($_SESSION['uid'],$data->column,$data->id)){ 
               http_response_code(201);         
                echo json_encode(array("message" => "Task moved"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "You have no permission to move"));
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

if($data->function == "updateTask"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id) && !empty($data->content) && !empty($data->title)
               && !empty($data->priority) && !empty($data->milestone) && !empty($data->deadline)
               && !empty($data->devId) && !empty($data->reviewId)){    

            if(Task::updateTask($data->id, $data->title, $data->content, $data->milestone, $data->priority, $data->deadline, $data->devId, $data->reviewId)){         
               http_response_code(201);         
                echo json_encode(array("message" => "Task updated."));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to update task!"));
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

if($data->function == "addMilestone"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->task) && !empty($data->milestone)){    
            
            if(Milestone::addMilestone($data->task, $data->milestone)){ 
               http_response_code(201);         
               echo json_encode(array("message" => "Milestone added!"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to add Milestone!"));
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

if($data->function == "deleteMilestone"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->task)){    
            
            if(Milestone::deleteMilestone($data->task)){ 
               http_response_code(201);         
               echo json_encode(array("message" => "Milestone deleted!"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to delete Milestone!"));
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

if($data->function == "getMilestoneStatus"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            $ered = Milestone::getMilestoneStatus($data->id);
            http_response_code(201);         
            echo json_encode(array("attachment" => $ered));

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

if($data->function == "getMentionByTask"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            $ered = Task::getMentionByTask($data->id);
            http_response_code(201);         
            echo json_encode(array("Mentions" => $ered));

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

if($data->function == "addTaskAttachment"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->task) && !empty($data->path)){    
            
            if(Attachment::uploadAttachment($data->task,-1, $data->path, $_SESSION['uid'])){         
            //if(Project::addProject($data->name, $data->description, $data->startDate, 11, $data->priority, $data->extraTime)){         
                http_response_code(201);         
                echo json_encode(array("message" => "Succesfully added attachment"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to add attachment!"));
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

if($data->function == "deleteTaskAttachment"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->attachment)){    
            
            if(Attachment::deleteAttachment($data->attachment, $_SESSION['uid'])){         
            //if(Project::addProject($data->name, $data->description, $data->startDate, 11, $data->priority, $data->extraTime)){         
                http_response_code(201);         
                echo json_encode(array("message" => "Succesfully deleted attachment"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to delete attachment!"));
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

if($data->function == "addTaskMention"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->task) && !empty($data->mentioned)){    
            
            if(User_X_Mention::mentionUser($data->mentioned,$_SESSION['uid'],-1, $data->task)){         
            http_response_code(201);         
                echo json_encode(array("message" => "Succesfully mentioned user"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to amention user!"));
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

if($data->function == "deleteTaskMention"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            if(User_X_Mention::deleteMention($data->id)){         
            //if(Project::addProject($data->name, $data->description, $data->startDate, 11, $data->priority, $data->extraTime)){         
                http_response_code(201);         
                echo json_encode(array("message" => "Succesfully deleted mention"));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to delete mention!"));
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