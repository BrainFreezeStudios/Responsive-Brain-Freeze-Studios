<?php

function getCodeProjects($mysqli)
{
    if($select_stmt = $mysqli->prepare("SELECT
                                        id,
                                        title,
                                        url,
                                        description,
                                        logo,
                                        licence
                                        FROM
                                        code
                                        ORDER BY date_created ASC"))
    {
        $select_stmt->execute();
        $result = $select_stmt->get_result();
        
        if($result->num_rows > 0)
        {
            for($x = 0; $x > $$result->num_rows; $x ++)
            {
                $code[] = $result->fetch_assoc();
            }
            $result->free_result();
            return $code;
        }
        else
        {
            $code = array(array("id" => "", "title"=> "", "description" => "No code projects where found"));
            return $code;
        }
    }
}

function getCodeProjectById($mysqli,$id)
{
    if($select_stmt = $mysqli->prepare("SELECT
                                            id,
                                            title,
                                            url,
                                            description,
                                            logo,
                                            license,
                                        FROM
                                            code
                                        WHERE
                                            id = ?
                                        LIMIT = 1"))
    {
        $select_stmt->bind_param('i',$id);
        $select_stmt->execute();
        
        $result = $select_stmt->get_result();
        
        if($result->num_rows > 0)
        {
            $code = $result->fetch_assoc();
            $result->free_result();
            return $code;
        }
        else
        {
            $code = array(array("id" => "", "title"=> "", "description" => "No code projects where found"));
            return $code;
        }
    }
}

function addCodeProject($mysqli, $title, $url, $description, $logo, $license, $autorid)
{
    if($insert_stmt = $mysqli->prepare("INSERT
                                        INTO
                                            code
                                            (title, url, description, logo, license, author_id)
                                        VALUES
                                            (?,?,?,?,?,?)"))
    {
        $insert_stmt->bind_param('sssssi', $title,$url,$description,$logo,$license,$autorid);
        $insert_stmt->execute();
        
    }
}

function editCodeProject($mysqli, $id,$title,$url,$description,$logo,$license,$authorid)
{
    if($update_stmt = $mysqli->prepare("UPDATE
                                            code
                                        SET
                                            title = ?,
                                            url = ?,
                                            description = ?,
                                            logo = ?,
                                            license = ?
                                        WHERE
                                            id = ?"))
    {
        $update_stmt->bind_param('sssssi',$title,$url,$description,$logo,$license,$id);
        $update_stmt->execute();
    }
}

function deleteCodeProject($mysqli, $id)
{
    if($update_stmt = $mysqli->prepare("DELETE
                                        FROM
                                            code
                                        WHERE
                                            id = ?"))
    {
        $update_stmt->bind_param('i',$id);
        $update_stmt->execute();
    }
}

?>
