<?php
function getVideos($mysqli)
{
    if($select_stmt = $mysqli->prepare("SELECT
                                            id,
                                            title,
                                            url,
                                            creation_date
                                         FROM
                                            videos
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
            $gallery = array(array("id" => NULL, "title"=> "No videos where found"));
            return $gallery;
        }
    }
}

function addVideo($title, $url, $mysqli) 
{
    if ($insert_stmt = $mysqli->prepare("INSERT INTO videos (title, url) VALUES (?, ?)"))
    {
        $insert_stmt->bind_param("ss",$title,$url);
        $insert_stmt->execute();
    }
}

function editVideo($videoid,$title, $url, $mysqli)
{
    if($update_stmt = $mysqli->prepare("UPDATE
                                            videos
                                        SET
                                            title=?,
                                            url=?
                                        WHERE
                                            id = ?"))
    {
        $update_stmt->bind_param("ss",$title,$url,$videoid);
        $update_stmt->execute();
    }
}

function deleteVideo($videoid,$mysqli)
{
    if ($delete_stmt = $mysqli->prepare("DELETE
                                         FROM
                                            videos
                                         WHERE
                                            id = ?"))
        {
            $delete_stmt->bind_param("i", $videoid);
            $delete_stmt->execute();
        }
}

function getImageById($videoid,$mysqli)
{
    if($select_stmt = $mysqli->prepare("SELECT
                                            id,
                                            title,
                                            url,
                                            creation_date
                                         FROM
                                            videos
                                         WHERE
                                            id = ?
                                         LIMIT 1"))
    {
        $select_stmt->bind_param('i',$videoid);
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
            $gallery = array(array("id" => NULL, "title"=> "No videos where found"));
            return $gallery;
        }
    }
}
?>
