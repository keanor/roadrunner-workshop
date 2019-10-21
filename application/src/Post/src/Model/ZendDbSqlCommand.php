<?php
declare(strict_types = 1);
namespace Post\Model;

use Post\Entity\Post;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;
use RuntimeException;

class ZendDbSqlCommand implements PostCommandInterface
{

    /**
     *
     * @var AdapterInterface
     */
    private $db;

    /**
     * Constructor
     *
     * @param AdapterInterface $db
     */
    public function __construct(AdapterInterface $db)
    {
        $this->db = $db;
    }

    /**
     * Persist a new post in the system.
     *
     * @param Post $post
     *            The post to insert; may or may not have an identifier.
     * @return Post The inserted post, with identifier.
     */
    public function insertPost(Post $post): Post
    {
        $insert = new Insert('posts');
        $insert->values([
            'title' => $post->getTitle(),
            'text' => $post->getText()
        ]);
        
        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        
        if (! $result instanceof ResultInterface) {
            throw new RuntimeException('Database error occurred during blog post insert operation');
        }
        
        $data = [
            'id' => $result->getGeneratedValue(),
            'title' => $post->getTitle(),
            'text' => $post->getText()
        ];
        
        return new Post($data);
    }

    /**
     * Update an existing post in the system.
     *
     * @param Post $post
     *            The post to update; must have an identifier.
     * @return Post The updated post.
     */
    public function updatePost(Post $post): Post
    {
        if (! $post->getId()) {
            throw new RuntimeException('Cannot update post; missing identifier');
        }
        
        $update = new Update('posts');
        $update->set([
            'title' => $post->getTitle(),
            'text' => $post->getText()
        ]);
        $update->where([
            'id = ?' => $post->getId()
        ]);
        
        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();
        
        if (! $result instanceof ResultInterface) {
            throw new RuntimeException('Database error occurred during blog post update operation');
        }
        
        return $post;
    }

    /**
     * Delete a post from the system.
     *
     * @param Post $post
     *            The post to delete.
     * @return bool
     */
    public function deletePost(Post $post): bool
    {
        if (! $post->getId()) {
            throw new RuntimeException('Cannot update post; missing identifier');
        }
        
        $delete = new Delete('posts');
        $delete->where([
            'id = ?' => $post->getId()
        ]);
        
        $sql = new Sql($this->db);
        $statement = $sql->prepareStatementForSqlObject($delete);
        $result = $statement->execute();
        
        if (! $result instanceof ResultInterface) {
            return false;
        }
        
        return true;
    }
}

