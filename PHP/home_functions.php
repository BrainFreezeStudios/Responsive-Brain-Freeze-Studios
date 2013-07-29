<?PHP
function populateHomeInfo($number, $section, $connection)
{
    switch ($section)
    {
        case 'blog':
            $query = 'SELECT id, title, date_posted, (SELECT first_name FROM hackers WHERE hackers.id = blog_posts.author_id ) as first_name, (SELECT last_name FROM hackers WHERE hackers.id = blog_posts.author_id ) as last_name, (SELECT nickname FROM hackers WHERE hackers.id = blog_posts.author_id ) as nickname FROM blog_posts ORDER BY date_posted DESC LIMIT :limit';
        break;
        case 'videos':
            $query = 'SELECT id, title, date_posted, (SELECT first_name FROM hackers WHERE hackers.id = videos.author_id)as first_name, (SELECT last_name FROM hackers WHERE hackers.id = videos.author_id) as last_name, (SELECT nickname FROM hackers WHERE hackers.id = videos.author_id ) as nickname FROM videos ORDER BY date_posted DESC LIMIT :limit';
        break;
        case 'gallery':
            $query = 'SELECT id, title, date_posted, (SELECT first_name FROM hackers WHERE hackers.id = gallery.author_id) as first_name, (SELECT last_name FROM hackers WHERE hackers.id = gallery.author_id) as last_name, (SELECT nickname FROM hackers WHERE hackers.id = gallery.author_id ) as nickname FROM gallery ORDER BY date_posted DESC LIMIT :limit';
        break;
        case 'code':
            $query ='SELECT id, title, date_posted, (SELECT first_name FROM hackers WHERE hackers.id = code.author_id) as first_name, (SELECT last_name FROM hackers WHERE hackers.id = code.author_id) as last_name, (SELECT nickname FROM hackers WHERE hackers.id = code.author_id) as nickname FROM code ORDER BY date_posted DESC LIMIT :limit';
        break;
        case 'steam':
            $query = 'SELECT id, title, date_posted, (SELECT first_name FROM hackers WHERE hackers.id = steam.author_id) as first_name, (SELECT last_name FROM hackers WHERE hackers.id = steam.author_id) as last_name, (SELECT nickname FROM hackers WHERE hackers.id = steam.author_id) as nickname FROM steam ORDER BY date_posted DESC LIMIT :limit';
        break;
        default:
            return false;
    }
    
    if($select_stmt = $connection->prepare($query))
    {
    
        $select_stmt->bindValue(':limit',$number);
        $select_stmt->execute();
        $result = $select_stmt->FetchAll();
        
        if($select_stmt->rowCount() >0)
        {
            return $result;
        }
        else
        {
            return false;
        }
    }
    return false;
}

?>