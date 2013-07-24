<?PHP

function getLatestBlogpost($number, $connection)
{
    $stmt = $connection->prepare('SELECT Title, Date_Created, Author FROM blog_posts ORDER BY date_created DESC LIMIT :limit');
    $stmt->bindValue(':limit',$number);
    $stmt->execute();
    $result = $stmt->fetchAll();
    
    if($stmt->rowCount() >1)
    {
        $blog[] = $result;
        return $blog;
    }
    else
    {
        return false;
    }
}

?>