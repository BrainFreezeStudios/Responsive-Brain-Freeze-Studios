<?php
function getWorkshop($mysqli)
{
    if($select_stmt = $mysqli->prepare("SELECT
                                            id,
                                            title,
                                            url,
                                            description,
                                            (SELECT first_name FROM hackers WHERE hackers.id = images.author_id ) as first_name,
                                            (SELECT last_name FROM hackers WHERE hackers.id = images.author_id ) as last_name,
                                            (SELECT nickname FROM hackers WHERE hackers.id = images.author_id )as nickname,
                                            thumbnail,
                                            creation_date
                                         FROM
                                            steam
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
            $gallery = array(array("id" => "", "title"=> "", "description" => "No images where found"));
            return $gallery;
        }
    }
}

function addWorkshop($title, $url, $description, $userid, $thumbnail, $mysqli) 
{
    if ($insert_stmt = $mysqli->prepare("INSERT INTO steam (title, url, description, author_id, thumbnail) VALUES (?, ?, ?, ?, ?, ?)"))
    {
        $insert_stmt->bind_param("ssiss",$title,$url,$description,$userid,$thumbnail);
        $insert_stmt->execute();
    }
}

function editWorkshop($imageid,$title, $url, $description, $userid, $thumbnail, $mysqli)
{
    if($update_stmt = $mysqli->prepare("UPDATE
                                            steam
                                        SET
                                            title=?,
                                            url=?
                                            description=?,
                                            thumbnail=?
                                        WHERE
                                            id = ?"))
    {
        $update_stmt->bind_param("ssssi",$title,$url,$description,$thumbnail,$imageid);
        $update_stmt->execute();
    }
}

function deleteWorkshop($imageid,$mysqli)
{
    if ($delete_stmt = $mysqli->prepare("DELETE
                                         FROM
                                            steam
                                         WHERE
                                            id = ?"))
        {
            $delete_stmt->bind_param("i", $imageid);
            $delete_stmt->execute();
        }
}

function getWorkshopById($imageid,$mysqli)
{
    if($select_stmt = $mysqli->prepare("SELECT
                                            id,
                                            title,
                                            url,
                                            description,
                                            (SELECT first_name FROM hackers WHERE hackers.id = images.author_id ) as first_name,
                                            (SELECT last_name FROM hackers WHERE hackers.id = images.author_id ) as last_name,
                                            (SELECT nickname FROM hackers WHERE hackers.id = images.author_id )as nickname,
                                            thumbnail,
                                            creation_date
                                         FROM
                                            steam
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
            $gallery = array(array("id" => "", "title"=> "", "description" => "No images where found"));
            return $gallery;
        }
    }
}
?>
