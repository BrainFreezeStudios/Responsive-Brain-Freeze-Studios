<?php

require_once 'useful_library.php';

    function getBlogPosts($mysqli)
    {
        if($select_stmt = $mysqli->prepare("SELECT
                                    id,
                                    title,
                                    (SELECT first_name FROM hackers WHERE hackers.id = blog_posts.author_id ) as first_name,
                                    (SELECT last_name FROM hackers WHERE hackers.id = blog_posts.author_id ) as last_name,
                                    (SELECT nickname FROM hackers WHERE hackers.id = blog_posts.author_id ) as nickname,
                                    post,
                                    description,
                                    date_posted,
                                    date_updated
                                FROM blog_posts
                                ORDER BY date_posted DESC"))
        {
            $select_stmt->execute();

            $result = $select_stmt->get_result();

            if($result->num_rows > 0)
            {

                for($x = 0 ; $x < $result->num_rows ; $x ++)
                {
                        $blogs[] = $result->fetch_assoc();
                }

                $result->free_result();
                return $blogs;
            }
            else
            {
                $date = new DateTime('2000-01-01');
                $blogs = array(
                                array(  "id" => NULL,
                                        "title"=> "No blogs entries where found",
                                        "description" => "No blogs entries where found",
                                        "date_posted" => $date,
                                        "date_updated"=> $date,
                                        "first_name" => "guy",
                                        "last_name" => "incognito",
                                        "nickname" => "unkown"));
                return $blogs;
            }
        }
    }

    function getTags($mysqli)
    {
        if($select_stmt = $mysqli->prepare("SELECT
                                blog_post_id,
                                tag_id,
                                (SELECT name FROM tags WHERE tags.id = blog_post_tags.tag_id) as name
                             FROM blog_post_tags 
                             ORDER BY name ASC"))
        {
            $select_stmt->execute();

            $result = $select_stmt->get_result();

            if($result->num_rows > 0)
            {
                for($x = 0 ; $x < $result->num_rows ; $x ++)
                {
                    $tags[] = $result->fetch_assoc();
                }

                $result->free_result();
                return $tags;
            }
            else
            {
                $tags = array(array("id" => NULL, "name" => "No tags where found"));
                return $tags;
            }
        }
    }

    function getBlogTags($blogid, $mysqli)
    {
        
        if($select_stmt = $mysqli->prepare("SELECT
                                    blog_post_id,
                                    tag_id,
                                    (SELECT name FROM tags WHERE tags.id = blog_post_tags.tag_id) as name
                                    FROM blog_post_tags
                                    WHERE blog_post_id = ? 
                                    ORDER BY name ASC"))
        {
            
            $select_stmt->bind_param('i',$blogid);
            $select_stmt->execute();


            $result = $select_stmt->get_result();
            

            if($result->num_rows > 0)
            {
                for($x = 0 ; $x < $result->num_rows ; $x ++)
                {
                    $tags[] = $result->fetch_assoc();
                }

                $result->free_result();
                return $tags;
            }
            else
            {
                $tags = array(array("tag_id" => "", "name" => "No tags where found"));
                return $tags;
            }
        }
    }

    function addBlog($title, $description, $post, $tags, $userid, $mysqli) 
    {
        if ($insert_stmt = $mysqli->prepare("INSERT INTO blog_posts (title, post, description, author_id) VALUES (?, ?, ?, ?)"))
        {
            $insert_stmt->bind_param('sssi', $title, $post, $description, $userid);
            $insert_stmt->execute();
            $blogid = $mysqli->insert_id;
            $blogtags = explode(",", $tags);

            foreach ($blogtags as $tag)
            {
                if ($select_stmt = $mysqli->prepare("SELECT id FROM tags WHERE name = ?")) 
                {

                    $select_stmt->bind_param("s", $tag);
                    $select_stmt->execute();
                    $select_stmt->store_result();

                    if ($select_stmt->num_rows() > 0)
                    {

                        $select_stmt->bind_result($tagid);
                        $select_stmt->fetch();
                        
                        if ($insert_stmt = $mysqli->prepare("INSERT INTO blog_post_tags (blog_post_id, tag_id) VALUES (?, ?)"))
                        {
                            $insert_stmt->bind_param('ii', $blogid, $tagid);
                            $insert_stmt->execute();
                        }
                        $select_stmt->free_result();
                    }
                    else
                    {
                        if ($insert_stmt2 = $mysqli->prepare("INSERT INTO tags (name) VALUES (?)"))
                        {
                            $insert_stmt2->bind_param('s', $tag);
                            $insert_stmt2->execute();
                            $tagid = $mysqli->insert_id;

                            if ($insert_stmt3 = $mysqli->prepare("INSERT INTO blog_post_tags (blog_post_id, tag_id) VALUES (?, ?)"))
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

    //Returns an array of associative arrays with all the blog tagged with an specific tag
    function getBlogsPerTag($tagid,$mysqli)
    {
        //Prepare a query that pulls all blog entryes that contain the required tag
       if($select_stmt = $mysqli->prepare("SELECT
                                            b.id,
                                            b.title,
                                            (SELECT first_name FROM hackers WHERE hackers.id = b.author_id ) as first_name,
                                            (SELECT last_name FROM hackers WHERE hackers.id = b.author_id ) as last_name,
                                            (SELECT nickname FROM hackers WHERE hackers.id = b.author_id )as nickname,
                                            b.post,
                                            b.description,
                                            b.date_posted,
                                            b.date_updated
                                            FROM blog_post_tags bt, blog_posts b, tags t
                                            WHERE bt.tag_id = t.id
                                            AND (t.id = (?))
                                            AND b.id = bt.blog_post_id
                                            ORDER BY b.date_posted ASC"))
       {
            $select_stmt->bind_param('i',$tagid);
            $select_stmt->execute();

            $result = $select_stmt->get_result();
            if($result->num_rows > 0)
            {
                for($x = 0 ; $x < $result->num_rows ; $x ++)
                {
                    $blogs[] = $result->fetch_assoc();
                }
                $result->free_result();
                return $blogs;

            }
            else
            {
                $date = new DateTime('2000-01-01');
                $blogs = array(
                                array(  "id" => NULL,
                                        "title"=> "No blogs entries where found",
                                        "description" => "No blogs entries where found",
                                        "date_posted" => $date,
                                        "date_updated"=> $date,
                                        "first_name" => "guy",
                                        "last_name" => "incognito",
                                        "nickname" => "unkown"));
                return $blogs;
            }
       }
    }

    //Returns an associative array with the specific blgo that matches the ID given
    function getBlogById($blogid,$mysqli,&$exists)
    {
        //Prepare a query that pulls the blog with the specific blog id
        if($select_stmt = $mysqli->prepare("SELECT
                                    id,
                                    title,
                                    (SELECT first_name FROM hackers WHERE hackers.id = blog_posts.author_id ) as first_name,
                                    (SELECT last_name FROM hackers WHERE hackers.id = blog_posts.author_id ) as last_name,
                                    (SELECT nickname FROM hackers WHERE hackers.id = blog_posts.author_id )as nickname,
                                    post,
                                    description,
                                    date_posted,
                                    date_updated
                                    FROM blog_posts
                                    WHERE id = ? LIMIT 1"))
        {
            
            $select_stmt->bind_param('i',$blogid);
            $select_stmt->execute();
            $result = $select_stmt->get_result();
            if($result->num_rows >0)
            {
                
                $blog = $result->fetch_assoc();
                $result->free_result();

                return $blog;
            }
            else
            {
                
                $date = new DateTime('2000-01-01');
                $blogs = array(
                                "id" => NULL,
                                        "title"=> "No blogs entries where found",
                                        "description" => "No blogs entries where found",
                                        "post" => "No blogs entries where found",
                                        "date_posted" => '2000-01-01',
                                        "date_updated"=> '2000-01-01',
                                        "first_name" => "guy",
                                        "last_name" => "incognito",
                                        "nickname" => "unkown");
                $exists = FALSE;
                return $blogs;
            }
        }
    }

    function blogExists($blogid, $mysqli)
    {
        
    }
    
    function getTagAsString($blogid,$mysqli)
    {
        $tags = getBlogTags($blogid,$mysqli);
        $stringtags="";
        foreach ($tags as $tag)
        {
              $stringtags = $stringtags.$tag['name'].",";
        }
        return $stringtags;
    }

    function editBlog($blogid,$title,$description,$blog,$tags,$mysqli)
    {
        //Prepare a query that updates the blog with the specific blog id
        if($update_stmt = $mysqli->prepare("UPDATE
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
            if($delete_stmt = $mysqli->prepare("DELETE
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
                if ($select_stmt = $mysqli->prepare("SELECT id FROM tags WHERE name = ?")) 
                {

                    $select_stmt->bind_param("s", $tag);
                    $select_stmt->execute();
                    $select_stmt->store_result();

                    if ($select_stmt->num_rows() > 0) 
                    {

                        $select_stmt->bind_result($tagid);
                        $select_stmt->fetch();
                        if ($insert_stmt = $mysqli->prepare("INSERT INTO blog_post_tags (blog_post_id, tag_id) VALUES (?, ?)"))
                        {
                            $insert_stmt->bind_param('ii', $blogid, $tagid);
                            $insert_stmt->execute();
                        }
                        $insert_stmt->free_result();
                    }
                    else
                    {
                        if ($insert_stmt2 = $mysqli->prepare("INSERT INTO tags (name) VALUES (?)"))
                        {
                            $insert_stmt2->bind_param('s', $tag);
                            $insert_stmt2->execute();
                            $tagid = $mysqli->insert_id;

                            if ($insert_stmt3 = $mysqli->prepare("INSERT INTO blog_post_tags (blog_post_id, tag_id) VALUES (?, ?)"))
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
    
    function deleteBlogPost($blogid,$mysqli)
    {
        if ($delete_stmt = $mysqli->prepare("DELETE
                                                FROM
                                                    blog_post_tags
                                                WHERE
                                                    blog_post_id = ?")) {
            $delete_stmt->bind_param("i", $blogid);
            $delete_stmt->execute();
        }

        if ($delete_stmt = $mysqli->prepare("DELETE
                                                    FROM
                                                        blog_posts
                                                    WHERE
                                                        id = ?")) {
            $delete_stmt->bind_param("i", $blogid);
            $delete_stmt->execute();
        }
    }
?>