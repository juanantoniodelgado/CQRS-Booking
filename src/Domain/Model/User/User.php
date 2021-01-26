<?php

declare(strict_types=1);

namespace App\Domain\Model\User;

use Doctrine\ORM\Mapping as ORM;

class User
{
    private $id;
    private $nickname;
}