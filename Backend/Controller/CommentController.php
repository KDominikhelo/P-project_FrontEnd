<?php

     require_once '../Model/Comment.php';
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

if($data->function == "createComment"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->taskId) && !empty($data->comment) && !empty($data->userId) && !empty($data->mentionedUser)){    

            if(Comment::addComment($data->taskId, $data->comment, $data->userId, $data->mentionedUser)){         
               http_response_code(201);         
                echo json_encode(array("message" => "Comment created."));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "Unable to create comment!"));
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

if($data->function == "deleteComment"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->comment)){    

            if(Comment::deleteComment($data->comment,$_SESSION['uid'])){         
                http_response_code(201);         
                echo json_encode(array("message" => "Comment deleted."));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "You dont have permission to delete it"));
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

if($data->function == "updateComment"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->comment) && !empty($data->content)){    

            if(Comment::updateComment($data->comment,$_SESSION['uid'],$data->content)){         
                http_response_code(201);         
                echo json_encode(array("message" => "Comment updated."));
            }
            else{         
                http_response_code(503);        
                echo json_encode(array("message" => "You dont have permission to update it"));
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

if($data->function == "getAttachmentByCommentId"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            $ered = Comment::getAttachmentByCommentId($data->id);
            http_response_code(201);         
            echo json_encode(array("Attachments" => $ered));

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

if($data->function == "getMentionByComment"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->id)){    
            $ered = Comment::getMentionByComments($data->id);
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

if($data->function == "addCommentAttachment"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->comment) && !empty($data->path)){    
            
            if(Attachment::uploadAttachment(-1, $data->comment, $data->path, $_SESSION['uid'])){         
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

if($data->function == "deleteCommentAttachment"){
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

if($data->function == "addCommentMention"){
    session_start();
    if(isset($_SESSION['uid'])){
        if(!empty($data->comment) && !empty($data->mentioned)){    
            
            if(User_X_Mention::mentionUser($data->mentioned,$_SESSION['uid'],$data->comment, -1)){         
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

if($data->function == "deleteCommentMention"){
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