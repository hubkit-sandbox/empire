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

namespace ParkManager\Module\Webhosting\Application\Account;

use ParkManager\Module\Webhosting\Domain\Account\WebhostingAccount;
use ParkManager\Module\Webhosting\Domain\Account\WebhostingAccountRepository;
use ParkManager\Module\Webhosting\Domain\DomainName\Exception\DomainNameAlreadyInUse;
use ParkManager\Module\Webhosting\Domain\DomainName\WebhostingDomainName;
use ParkManager\Module\Webhosting\Domain\DomainName\WebhostingDomainNameRepository;
use ParkManager\Module\Webhosting\Domain\Package\WebhostingPackageRepository;

/**
 * @author Sebastiaan Stok <s.stok@rollerworks.net>
 */
final class RegisterWebhostingAccountHandler
{
    private $accountRepository;
    private $packageRepository;
    private $domainNameRepository;

    public function __construct(
        WebhostingAccountRepository $accountRepository,
        WebhostingPackageRepository $packageRepository,
        WebhostingDomainNameRepository $domainNameRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->packageRepository = $packageRepository;
        $this->domainNameRepository = $domainNameRepository;
    }

    public function __invoke(RegisterWebhostingAccount $command): void
    {
        /** @var WebhostingAccount|string $className */
        $className = $this->accountRepository->getModelClass();
        $domainName = $command->domainName();

        if (null !== $currentRegistration = $this->domainNameRepository->findByFullName($domainName)) {
            throw DomainNameAlreadyInUse::byAccountId($domainName, $currentRegistration->account()->id());
        }

        if (null !== $packageId = $command->package()) {
            /** @var WebhostingAccount $account */
            $account = $className::register(
                $command->id(),
                $command->owner(),
                $this->packageRepository->get($packageId)
            );
        } else {
            /** @var WebhostingAccount $account */
            $account = $className::registerWithCustomCapabilities(
                $command->id(),
                $command->owner(),
                $command->customCapabilities()
            );
        }

        /** @var WebhostingDomainName|string $primaryDomainNameClass */
        $primaryDomainNameClass = $this->domainNameRepository->getModelClass();
        $primaryDomainName = $primaryDomainNameClass::registerPrimary($account, $domainName);

        $this->accountRepository->save($account);
        $this->domainNameRepository->save($primaryDomainName);
    }
}