<?php

declare(strict_types=1);

/*
 * Copyright (c) the Contributors as noted in the AUTHORS file.
 *
 * This file is part of the Park-Manager project.
 *
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Doctrine\ORM\EntityManagerInterface;
use ParkManager\Component\SharedKernel\Event\EventEmitter;
use ParkManager\Module\Webhosting\Domain\Account\WebhostingAccountRepository;
use ParkManager\Module\Webhosting\Infrastructure\Doctrine\Account\WebhostingAccountOrmRepository;

return function (ContainerConfigurator $c) {
    $di = $c->services()->defaults()
        ->autowire()
        ->autoconfigure()
        // Bindings
        ->bind(EventEmitter::class, ref('park_manager.command_bus.webhosting.domain_event_emitter'))
        ->bind(EntityManagerInterface::class, ref('doctrine.orm.entity_manager'));

    $di->set(WebhostingAccountOrmRepository::class)
        ->alias(WebhostingAccountRepository::class, WebhostingAccountOrmRepository::class);
};
