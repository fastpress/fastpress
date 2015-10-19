<?php

namespace App\Model;

class BlogRepository{
    private static $db;
    public static function init(array $db){
        self::$db = new \PDO(
                'mysql:host=localhost;dbname=fastpress_app', 'root', 'samayo'
            );

        return self::$db;
    }

    static function getAll(){
    	$stmt = self::$db->query("SELECT title, slug, tags, content, date_added, DATE_FORMAT(date_added, '%W %m, %Y') as day_name FROM blogs"); 
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if($result){
            return $result;       
        }
    }
    
    function getBySlug($slug){
    	$stmt = $this->pdo->prepare("
    		SELECT title, content, tags, slug, DATE_FORMAT(date_added, '%W %m, %Y') as day_name
    		FROM blogs 
    		WHERE slug = ? LIMIT 1"); 

    	$stmt->execute([$slug]); 

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($result){
            return $result; 
        }
    }

    private function addTags($tags, $blog_id){
    	$tags = explode(',', $tags);

    	foreach ($tags as $tag) {
    		$tag = trim($tag); 
	    	$stmt = $this->pdo->prepare("
	    		INSERT INTO tags (tag, blog_id, date_added)
	    		VALUES (?, ?, CURDATE())
	    	"); 

	    	$result = $stmt->execute([$tag, $blog_id]); 	
    	}



	
    	 
    }

    function addBlog(array $input){
    	$slug = $input['title']; 
    	$slug = strtolower($slug);
    	$slug = str_replace([' ', '\'', ','], '-', $slug);
        $content_preview = $s = preg_replace('/\W/ui', ' .. ', $input['content']);

    	$stmt = $this->pdo->prepare("
    		INSERT INTO blogs 
    		(title, slug, tags, content_preview, content, date_added, is_active)
			VALUES 
			(?, ?, ?, ?, ?, NOW(), 1)    		
    	");

    	$result = $stmt->execute([
    			$input['title'], 
    			$slug, 
    			$input['tags'], 
                $content_preview,
    			$input['content'], 
    		]);
		$result =  $this->pdo->lastInsertId();
    	
    	$tags = $this->addTags($input['tags'], $result); 
    }


    function getByTags($keyword){
    	$stmt = $this->pdo->prepare("
    		SELECT blogs.slug, blogs.title, blogs.content, blogs.date_added, blogs.id
    			FROM blogs 
    			INNER JOIN tags
    				ON tags.blog_id = blogs.id 
    			
    			WHERE tags.tag = ?
    		");

    	$result = $stmt->execute([$keyword]); 

    	if($result){
    		return $stmt->fetchAll();
    	}
    }
    
}


