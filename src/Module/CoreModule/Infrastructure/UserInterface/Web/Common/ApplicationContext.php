<?php

declare(strict_types=1);

/*
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace ParkManager\Module\CoreModule\Infrastructure\UserInterface\Web\Common;

use InvalidArgumentException;
use RuntimeException;
use function sprintf;

/**
 * @final
 */
class ApplicationContext
{
    public const SECTIONS = [
        'admin' => true,
        'client' => true,
        'private' => true,
        'api' => true,
    ];

    /** @var string|null */
    private $activeSection;

    /** @var bool */
    private $privateSection = false;

    public function setActiveSection(string $section): void
    {
        if (! isset(self::SECTIONS[$section])) {
            throw new InvalidArgumentException(sprintf('Section "%s" is not supported.', $section));
        }

        $this->privateSection = $section === 'private';
        $this->activeSection  = $section === 'private' ? 'client' : $section;
    }

    public function reset(): void
    {
        $this->activeSection  = null;
        $this->privateSection = false;
    }

    public function getActiveSection(): string
    {
        $this->guardRepositoryIsActive();

        return $this->activeSection;
    }

    public function isPrivateSection(): bool
    {
        $this->guardRepositoryIsActive();

        return $this->privateSection;
    }

    public function getRouteNamePrefix(): string
    {
        $this->guardRepositoryIsActive();

        return $this->activeSection;
    }

    private function guardRepositoryIsActive(): void
    {
        if ($this->activeSection === null) {
            throw new RuntimeException('No active section was set.');
        }
    }
}
