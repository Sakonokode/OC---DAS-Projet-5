<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

/**
 * Class PostFixtures
 * @package App\DataFixtures
 */
class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var User $author */
        $author = $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);
        $posts = Yaml::parseFile(__DIR__ . '/fixtures/posts.yaml');

        foreach ($posts['posts'] as $item => $currentPost) {
            $comments = $manager->getRepository(Comment::class)->findAll();
            $post = new Post();
            $post->setAuthor($author);
            $post->setTitle($currentPost['title']);
            $post->setContent($currentPost['content']);
            $post->setComments($comments);

            /** @var Category $category */
            $category = $this->getReference($currentPost['category']);
            $post->addCategory($category);

            $manager->persist($post);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return array(
            UserFixtures::class,
            CategoryFixtures::class,
            CommentFixtures::class,
        );
    }
}