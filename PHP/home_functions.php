<?PHP
function populateHomeInfo($number, $section, $connection)
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

?>