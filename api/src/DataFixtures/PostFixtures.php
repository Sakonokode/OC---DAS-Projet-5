<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

/**
 * Class PostFixtures
 * @package App\DataFixtures
 */
class PostFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        /** @var User $author */
        $author = $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);
        $posts = Yaml::parseFile(__DIR__ . '/fixtures/posts.yaml');

        foreach ($posts['posts'] as $item => $currentPost) {
            $post = new Post();
            $post->setAuthor($author);
            $post->setTitle($currentPost['title']);
            $post->setContent($currentPost['content']);

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
        );
    }
}