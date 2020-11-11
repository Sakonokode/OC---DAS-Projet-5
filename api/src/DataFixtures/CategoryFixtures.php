<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Category;
use Symfony\Component\Yaml\Yaml;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class CategoryFixtures
 * @package App\DataFixtures
 */
class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $categories = (array) Yaml::parseFile(__DIR__ . '/fixtures/categories.yaml');

        foreach ($categories['categories'] as $item => $currentCategory) {
            $category = new Category();
            $category->setTitle((string) $currentCategory['name']);
            $this->setReference((string) $currentCategory['name'], $category);

            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            UserFixtures::class,
        );
    }
}