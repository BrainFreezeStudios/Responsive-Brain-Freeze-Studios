<?php
function getGallery($PDO)
{
    if($select_stmt = $PDO->prepare("SELECT
                                            id,
                                            title,
                                            image,
                                            description,
                                            (SELECT first_name FROM hackers WHERE hackers.id = images.author_id ) as first_name,
                                            (SELECT last_name FROM hackers WHERE hackers.id = images.author_id ) as last_name,
                                            (SELECT nickname FROM hackers WHERE hackers.id = images.author_id )as nickname,
                                            license,
                                            thumbnail,
                                            creation_date
                                         FROM
                                            gallery
                                         ORDER BY creation_date ASC"))
    {
        $select_stmt->execute();

        $result = $select_stmt->get_result();

        if($result->num_rows > 0)
        {

            for($x = 0 ; $x < $result->num_rows ; $x ++)
            {
                    $gallery[] = $result->fetch_assoc();
            }            
            $result->free_result();
            return $gallery;
        }
        else
        {
            //$gallery = array(array("id" => NULL, "title"=> "No images where found", "description" => "No images where found"));
            return false;
        }
    }
    return false;
}

function addImages($title, $url, $description, $userid, $license, $thumbnail, $PDO) 
{
    if ($insert_stmt = $PDO->prepare("INSERT INTO images (title, url, description, author_id, license, thumbnail) VALUES (?, ?, ?, ?, ?, ?)"))
    {
        $insert_stmt->bind_param("sssiss",$title,$url,$description,$userid,$license,$thumbnail);
        $insert_stmt->execute();
    }
}

function editImages($imageid,$title, $url, $description, $userid, $license, $thumbnail, $PDO)
{
    if($update_stmt = $PDO->prepare("UPDATE
                                            images
                                        SET
                                            title=?,
                                            url=?
                                            description=?,
                                            license=?,
                                            thumbnail=?
                                        WHERE
                                            id = ?"))
    {
        $update_stmt->bind_param("sssssi",$title,$url,$description,$license,$thumbnail,$imageid);
        $update_stmt->execute();
    }
}

function deleteImages($imageid,$PDO)
{
    if ($delete_stmt = $PDO->prepare("DELETE
                                         FROM
                                            images
                                         WHERE
                                            id = ?"))
        {
            $delete_stmt->bind_param("i", $imageid);
            $delete_stmt->execute();
        }
}

function getImageById($imageid,$PDO)
{
    if($select_stmt = $PDO->prepare("SELECT
                                            id,
                                            title,
                                            url,
                                            description,
                                            (SELECT first_name FROM hackers WHERE hackers.id = images.author_id ) as first_name,
                                            (SELECT last_name FROM hackers WHERE hackers.id = images.author_id ) as last_name,
                                            (SELECT nickname FROM hackers WHERE hackers.id = images.author_id )as nickname,
                                            license,
                                            thumbnail,
                                            creation_date
                                         FROM
                                            images
                                         WHERE
                                            id = ?
                                         LIMIT 1"))
    {
        $select_stmt->bind_param('i',$imageid);
        $select_stmt->execute();

        $result = $select_stmt->get_result();

        if($result->num_rows > 0)
        {

            for($x = 0 ; $x < $result->num_rows ; $x ++)
            {
                    $gallery[] = $result->fetch_assoc();
            }

            $result->free_result();
            return $gallery;
        }
        else
        {
            $gallery = array(array("id" => NULL, "title"=> "No images where found", "description" => "No images where found"));
            return $gallery;
        }
    }
}
?>
