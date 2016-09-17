<?php

namespace AppBundle\Security\User;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

use AppBundle\Entity\ApiUser;
use Doctrine\ORM\EntityRepository;

class ApiUserProvider extends EntityRepository implements UserProviderInterface
{

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    public function loadUserByUsername($username)
    {       
        $q = $this->em->createQuery(
            'SELECT u
             FROM AppBundle:ApiUser u
             WHERE u.username = :username'
        )->setParameter('username', $username);
        $userData = $q->getSingleResult();

        if ($userData) {
            return $userData;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof ApiUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'AppBundle\Entity\ApiUser';
    }
}