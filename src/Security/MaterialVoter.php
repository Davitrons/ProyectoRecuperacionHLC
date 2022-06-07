<?php

namespace App\Security;

use App\Entity\Material;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class MaterialVoter extends Voter{

    const PRESTAR_MATERIAL = 'PRESTAR_MATERIAL';

    /**
     * @var AccessDecisionManagerInterface
     */
    private $accessDecisionManager;

    public function __construct(AccessDecisionManagerInterface $accessDecisionManager)
    {
        $this->accessDecisionManager = $accessDecisionManager;
    }

    /**
     * @inheritDoc
     */
    protected function supports($attribute, $subject)
    {
        if (!$subject instanceof Material) {
            return false;
        }

        if ($attribute === self::PRESTAR_MATERIAL) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if (!$subject instanceof Material) {
            return false;
        }

        if ($this->accessDecisionManager->decide($token, ['ROLE_GESTOR_PRESTAMOS'])) {
            return true;
        }

        if ($attribute === self::PRESTAR_MATERIAL
            && $subject->getPrestadoPor() == $token->getUser()) {
            return true;
        }

        return false;
    }
}