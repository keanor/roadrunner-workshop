<?php
declare(strict_types = 1);
namespace Post\Model;

use Post\Entity\Post;

class PostCommand implements PostCommandInterface
{

    /**
     *
     * {@inheritdoc}
     *
     */
    public function insertPost(Post $post): Post
    {}

    /**
     *
     * {@inheritdoc}
     *
     */
    public function updatePost(Post $post): Post
    {}

    /**
     *
     * {@inheritdoc}
     *
     */
    public function deletePost(Post $post): bool
    {}
}

