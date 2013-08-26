<?PHP

function addBlog($title, $description, $post, $tags, $userid, $connection) 
    {
        if ($insert_stmt = $connection->prepare("INSERT INTO blog_posts (title, post, description, author_id) VALUES (:title, :post, :description, :author_id)"))
        {
            
            $insert_stmt->execute(array(
                ':username' => $title,
                ':password' => $post,
                ':first_name' => $description,
                ':last_name' => $userid
            ));
            
           /* $insert_stmt->bind_param('sssi', $title, $post, $description, $userid);
            $insert_stmt->execute();
            */
            $blogid = $connection->lastInsertId();
            $blogtags = explode(",", $tags);

            foreach ($blogtags as $tag)
            {
                if ($select_stmt = $connection->prepare("SELECT id FROM tags WHERE name = :tag")) 
                {

                    $select_stmt->bindParam(":tag", $tag);
                    $select_stmt->execute();
                    $tagid = $select_stmt->fetch();

                    if ($select_stmt->num_rows() > 0)
                    {

                       /* $select_stmt->bind_result($tagid);
                        $select_stmt->fetch();*/
                        
                        if ($insert_stmt = $connection->prepare("INSERT INTO blog_post_tags (blog_post_id, tag_id) VALUES (:blogid, :tagid)"))
                        {
                            /*$insert_stmt->bind_param('ii', $blogid, $tagid);*/
                            $insert_stmt->execute(array(":blogid" => $blogid, "tagid" => $tagid));
                        }
                        //$select_stmt->free_result();
                    }
                    else
                    {
                        if ($insert_stmt2 = $connection->prepare("INSERT INTO tags (name) VALUES (:tag)"))
                        {
                            $insert_stmt2->bindParam(':tag', $tag);
                            $insert_stmt2->execute();
                            $tagid = $connection->lastInsertId();

                            if ($insert_stmt3 = $connection->prepare("INSERT INTO blog_post_tags (blog_post_id, tag_id) VALUES (:blogid, tagid)"))
                            {
                                //$insert_stmt3->bind_param('ii', $blogid, $tagid);
                                $insert_stmt3->execute(array(":blodid" => $blogid, ":tagid" => $tagid));
                            }
                        }
                    }
                }               
            }
        }
    }

function editBlog($blogid,$title,$description,$blog,$tags,$connection)
    {
        //Prepare a query that updates the blog with the specific blog id
        if($update_stmt = $connection->prepare("UPDATE
                                                blog_posts
                                            SET
                                                title=?,
                                                description=?,
                                                post=?,
                                                date_updated=?
                                            WHERE
                                                id = ?"))
        {

            $dateupdated = idate("Y")."-".idate("m")."-".idate("d")." ".idate("H").":".idate("i").":".idate("s");
            $update_stmt->bind_param("ssssi",$title,$description,$blog,$dateupdated,$blogid);
            $update_stmt->execute();
            $tags = explode(",", $tags);
            $tags = array_filter($tags);
            array_walk($tags, 'trim_value');
            sort($tags);
            

            //Delete all the asociations tags - blog from the table
            if($delete_stmt = $connection->prepare("DELETE
                                                FROM
                                                    blog_post_tags
                                                WHERE
                                                    blog_post_id = ?"))
            {
                $delete_stmt->bind_param("i",$blogid);
                $delete_stmt->execute();
            }

            foreach ($tags as $tag)
            {
                //search for the tag to see if it exists
                if ($select_stmt = $connection->prepare("SELECT id FROM tags WHERE name = ?")) 
                {

                    $select_stmt->bind_param("s", $tag);
                    $select_stmt->execute();
                    $select_stmt->store_result();

                    if ($select_stmt->num_rows() > 0) 
                    {

                        $select_stmt->bind_result($tagid);
                        $select_stmt->fetch();
                        if ($insert_stmt = $connection->prepare("INSERT INTO blog_post_tags (blog_post_id, tag_id) VALUES (?, ?)"))
                        {
                            $insert_stmt->bind_param('ii', $blogid, $tagid);
                            $insert_stmt->execute();
                        }
                        $insert_stmt->free_result();
                    }
                    else
                    {
                        if ($insert_stmt2 = $connection->prepare("INSERT INTO tags (name) VALUES (?)"))
                        {
                            $insert_stmt2->bind_param('s', $tag);
                            $insert_stmt2->execute();
                            $tagid = $connection->insert_id;

                            if ($insert_stmt3 = $connection->prepare("INSERT INTO blog_post_tags (blog_post_id, tag_id) VALUES (?, ?)"))
                            {
                                $insert_stmt3->bind_param('ii', $blogid, $tagid);
                                $insert_stmt3->execute();
                            }
                        }
                    }
                }
             }
        }
    }
    
    function deleteBlogPost($blogid,$connection)
    {
        if ($delete_stmt = $connection->prepare("DELETE
                                                FROM
                                                    blog_post_tags
                                                WHERE
                                                    blog_post_id = ?")) {
            $delete_stmt->bind_param("i", $blogid);
            $delete_stmt->execute();
        }

        if ($delete_stmt = $connection->prepare("DELETE
                                                    FROM
                                                        blog_posts
                                                    WHERE
                                                        id = ?")) {
            $delete_stmt->bind_param("i", $blogid);
            $delete_stmt->execute();
        }
    }
    
        function getTagAsString($blogid,$connection)
    {
        $tags = getBlogTags($blogid,$connection);
        $stringtags="";
        foreach ($tags as $tag)
        {
              $stringtags = $stringtags.$tag['name'].",";
        }
        return $stringtags;
    }

?>