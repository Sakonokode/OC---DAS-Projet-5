<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class UserFixtures
 * @package App\DataFixtures
 */
final class UserFixtures extends Fixture
{
    public const ADMIN_USER_REFERENCE = 'admin@gmail.com';

    /** @var UserPasswordEncoderInterface $passEncoder */
    private $passEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passEncoder = $passwordEncoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $users = Yaml::parseFile(__DIR__ . '/fixtures/users.yaml');

        foreach ($users['users'] as $nickName => $user) {

            $user = $this->instantiate(
                $user['email'],
                $user['password'],
                $user['roles'],
                $user['username']
            );

            if ($nickName = 'admin') {
                $this->setReference(self::ADMIN_USER_REFERENCE, $user);
            }

            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * @param string|null $email
     * @param string|null $password
     * @param array|null $roles
     * @return User
     */
    public function instantiate(
        string $email = null,
        string $password = null,
        array $roles = null,
        string $username
    ): User
    {
        $user = new User($username);
        $user->setEmail($email);
        $user->setPassword($this->passEncoder->encodePassword($user, $password));
        $user->setRoles($roles);

        return $user;
    }
}
