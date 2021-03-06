<?php

function getResourceListLimit($number, $section, $connection)
{
    switch ($section)
    {
        case 'blog':
            $query = 'SELECT * FROM blogs ORDER BY create_time DESC LIMIT :limit';
        break;
        case 'videos':
            $query = 'SELECT * FROM videos ORDER BY create_time DESC LIMIT :limit';
        break;
        case 'gallery':
            $query = 'SELECT * FROM images ORDER BY create_time DESC LIMIT :limit';
        break;
        case 'code':
            $query = 'SELECT * FROM codes ORDER BY create_time DESC LIMIT :limit';
        break;
        case 'steam':
            $query = 'SELECT * FROM steams ORDER BY create_time DESC LIMIT :limit';
        break;
        default:
            return false;
    }
    
    if($select_stmt = $connection->prepare($query))
    {
        //echo "here";
        $select_stmt->bindParam(':limit',$number, PDO::PARAM_INT);
        $select_stmt->execute();
        $result = $select_stmt->FetchAll();
        
        //echo "here tooooooo";
        //echo count($result);
        
        if(count($result))
        {
            //echo "here too and too";
            return $result;
        }
        else
        {
            return false;
        }
    }
    return false;
}

function getResourcesList($connection,$type)
{
    switch($type)
    {
        case "blog":
            
            $query ="SELECT * FROM blogs";
            
        break;
        case "video":
            
            $query ="SELECT * FROM videos";
            
        break;
        case "image":
            
            $query ="SELECT * FROM images";
            
        break;
        case "steam":
            
            $query ="SELECT * FROM steams";
            
        break;
        case "code":
            
            $query ="SELECT * FROM codes";
            
        break;
    
        default:
            return false;
    }
    if($select_stmt = $connection->prepare($query))
    {
        $select_stmt->execute();
        $result = $select_stmt->fetchAll();

            if(count($result))
            {
                
                return $result;
            }
            else
            {
                return false;
            }
    }
    else
    {
        return false;
    }
}

function getResourcesPerId($connection,$type,$id)
{
    switch($type)
    {
        case "blog":
            
            $query ="SELECT * FROM blogs WHERE id_resources = :id LIMIT 1 ";
            
        break;
        case "video":
            
            $query ="SELECT * FROM videos WHERE id_resources = :id LIMIT 1";
            
        break;
        case "image":
            
            $query ="SELECT * FROM images WHERE id_resources = :id LIMIT 1";
            
        break;
        case "steam":
            
            $query ="SELECT * FROM steams WHERE id_resources = :id LIMIT 1";
            
        break;
        case "code":
            
            $query ="SELECT * FROM codes WHERE id_resources = :id LIMIT 1";
            
        break;
    
        default:
            return false;
    }
    if($select_stmt = $connection->prepare($query))
    {
        $select_stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $select_stmt->execute();
        $result = $select_stmt->fetchAll();

            if(count($result))
            {
                
                return $result;
            }
            else
            {
                return false;
            }
    }
    else
    {
        return false;
    }
}

function getResourcesPerTag($connection,$type,$tagId)
{
    
    switch($type)
    {
        case "blog":
            
            $query ="SELECT * FROM blogs WHERE find_in_set(:tagId, cast(id_tags as char)) > 0";
            
        break;
        case "video":
            
            $query ="SELECT * FROM videos WHERE find_in_set(:tagId, cast(id_tags as char)) > 0";
            
        break;
        case "image":
            
            $query ="SELECT * FROM images WHERE find_in_set(:tagId, cast(id_tags as char)) > 0";
            
        break;
        case "steam":
            
            $query ="SELECT * FROM steams WHERE find_in_set(:tagId, cast(id_tags as char)) > 0";
            
        break;
        case "code":
            
            $query ="SELECT * FROM codes WHERE find_in_set(:tagId, cast(id_tags as char)) > 0";
            
        break;
    
        default:
            return false;
    }
    if($select_stmt = $connection->prepare($query))
    {
        $select_stmt->bindParam(':tagId',$id,PDO::PARAM_INT);
        $select_stmt->execute();
        $result = $select_stmt->fetchAll();

            if(count($result))
            {
                
                return $result;
            }
            else
            {
                return false;
            }
    }
    else
    {
        return false;
    }
}


?>
