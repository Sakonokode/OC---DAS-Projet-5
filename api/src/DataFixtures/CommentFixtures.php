<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

/**
 * Class CommentFixtures
 * @package App\DataFixtures
 */
class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $comments = (array) Yaml::parseFile(__DIR__ . '/fixtures/comments.yaml');

        foreach ($comments['comments'] as $item => $currentComment) {
            $comment = new Comment();
            $comment->setContent($currentComment['content']);
            $author = $manager->getRepository(User::class)->find($currentComment['author']);
            $comment->setAuthor($author);

            if (!empty($currentComment['children'])) {
                $children = new Comment();
                $children->setContent($currentComment['content']);
                $children->setAuthor($author);
                $children->setParent($comment);
                $comment->addChildren($children);
            }

            $manager->persist($comment);
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
        );
    }
}