<?php
declare(strict_types = 1);
namespace Post\Model;

use Post\Entity\Post;

interface PostRepositoryInterface
{

    /**
     * Return a single blog post.
     *
     * @param int $id
     *            Identifier of the post to return.
     * @return Post
     */
    public function findPost($id);

    /**
     * Return a set of all blog posts that we can iterate over.
     *
     * Each entry should be a Post instance.
     *
     * @return Post[]
     */
    public function findAllPosts();
}

