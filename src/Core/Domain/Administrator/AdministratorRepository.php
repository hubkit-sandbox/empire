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

namespace ParkManager\Core\Domain\Administrator;

use ParkManager\Component\User\Model\UserCollection;
use ParkManager\Component\User\Model\UserId;

/**
 * @author Sebastiaan Stok <s.stok@rollerworks.net>
 *
 * @method get(UserId $id): Administrator
 * @method findByEmailAddress(string $email): Administrator
 * @method findByEmailAddressChangeToken(string $selector): Administrator
 */
interface AdministratorRepository extends UserCollection
{
}