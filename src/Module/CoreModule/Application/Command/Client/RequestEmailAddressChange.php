<?php

declare(strict_types=1);

/*
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace ParkManager\Module\CoreModule\Application\Command\Client;

use ParkManager\Module\CoreModule\Domain\Client\ClientId;
use ParkManager\Module\CoreModule\Domain\Shared\EmailAddress;

final class RequestEmailAddressChange
{
    private $id;
    private $email;

    public function __construct(string $id, string $email)
    {
        $this->id    = ClientId::fromString($id);
        $this->email = new EmailAddress($email);
    }

    public function id(): ClientId
    {
        return $this->id;
    }

    public function email(): EmailAddress
    {
        return $this->email;
    }
}
