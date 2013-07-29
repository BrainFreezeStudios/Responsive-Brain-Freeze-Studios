<?php

require_once 'useful_library.php';

    function getBlogPosts($connection)
    {
        if($select_stmt = $connection->prepare("SELECT
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

            $result = $select_stmt->fetchAll();

            if($select_stmt->rowCount() >1)
            {
                /*
                for($x = 0 ; $x < $result->num_rows ; $x ++)
                {
                        $blogs[] = $result->fetch_assoc();
                }

                $result->free_result();
                */
                return $result;
            }
            else
            {
                /*
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
                */
                return false;
            }
        }
    }

    function getTags($connection)
    {
        if($select_stmt = $connection->prepare("SELECT
                                blog_post_id,
                                tag_id,
                                (SELECT name FROM tags WHERE tags.id = blog_post_tags.tag_id) as name
                             FROM blog_post_tags 
                             ORDER BY name ASC"))
        {
            $select_stmt->execute();

            $result = $select_stmt->fetchAll();

            if($select_stmt->rowCount() > 0)
            {
                /*
                for($x = 0 ; $x < $result->num_rows ; $x ++)
                {
                    $tags[] = $result->fetch_assoc();
                }

                $result->free_result();
                */
                return $result;
            }
            else
            {
                /*
                $tags = array(array("id" => NULL, "name" => "No tags where found"));
                */
                return $result;
            }
        }
    }

    function getBlogTags($blogid, $connection)
    {
        
        if($select_stmt = $connection->prepare("SELECT
                                    blog_post_id,
                                    tag_id,
                                    (SELECT name FROM tags WHERE tags.id = blog_post_tags.tag_id) as name
                                    FROM blog_post_tags
                                    WHERE blog_post_id = :id 
                                    ORDER BY name ASC"))
        {
            
            $select_stmt->bindValue(':id',$blogid);
            $select_stmt->execute();


            $result = $select_stmt->fetchAll();
            

            if($select_stmt->rowCount() > 0)
            {
                /*
                for($x = 0 ; $x < $result->num_rows ; $x ++)
                {
                    $tags[] = $result->fetch_assoc();
                }

                $result->free_result();
                */
                return $result;
            }
            else
            {
                /*
                $tags = array(array("tag_id" => "", "name" => "No tags where found"));
                */
                return false;
            }
        }
    }

    //Returns an array of associative arrays with all the blog tagged with an specific tag
    function getBlogsPerTag($tagid,$connection)
    {
        //Prepare a query that pulls all blog entryes that contain the required tag
       if($select_stmt = $connection->prepare("SELECT
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
                                            AND (t.id = (:tagid))
                                            AND b.id = bt.blog_post_id
                                            ORDER BY b.date_posted ASC"))
       {
            $select_stmt->bindValue(':tagid',$tagid);
            $select_stmt->execute();

            $result = $select_stmt->fetchAll();
            if($select_stmt->rowCount() > 0)
            {
                /*for($x = 0 ; $x < $result->num_rows ; $x ++)
                {
                    $blogs[] = $result->fetch_assoc();
                }
                $result->free_result();*/
                return $result;

            }
            else
            {
                /*
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
                */
                return false;
            }
       }
    }

    //Returns an associative array with the specific blog that matches the ID given
    function getBlogById($blogid,$connection)
    {
        //Prepare a query that pulls the blog with the specific blog id
        if($select_stmt = $connection->prepare("SELECT
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
                                    WHERE id = :blogid LIMIT 1"))
        {
            
            $select_stmt->bindValue(':blogid',$blogid);
            $select_stmt->execute();
            $result = $select_stmt->fetchAll();
            
            if($select_stmt->rowCount() >0)
            {
                /*
                $blog = $result->fetch_assoc();
                $result->free_result();
                */
                return $result;
            }
            else
            {
                /*
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
                */
                return false;
            }
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