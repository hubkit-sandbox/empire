<?php

declare(strict_types=1);

/*
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace ParkManager\Module\WebhostingModule\Domain\Account\Event;

use ParkManager\Component\DomainEvent\DomainEvent;
use ParkManager\Module\WebhostingModule\Domain\Account\WebhostingAccountId;

final class WebhostingAccountWasMarkedForRemoval extends DomainEvent
{
    private $id;

    public function __construct(WebhostingAccountId $id)
    {
        $this->id = $id;
    }

    public function id(): WebhostingAccountId
    {
        return $this->id;
    }
}
