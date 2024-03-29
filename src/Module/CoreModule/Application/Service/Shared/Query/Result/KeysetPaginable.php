<?php

declare(strict_types=1);

/*
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace ParkManager\Module\CoreModule\Application\Service\Shared\Query\Result;

/**
 * The KeysetPaginable is implemented by a provider to limit
 * the amount of records returned and providing information
 * on how to get to the next page (using an ElementIdentifier).
 *
 * Note: Unlike offset paging this technique only allows a prev/next
 * paging but no total or fast forward to a specific page.
 *
 * Because of how records are searched the sorting is required,
 * and cannot be ignored.
 *
 * @see http://use-the-index-luke.com/no-offset
 */
interface KeysetPaginable
{
    public const SORT_ASCENDING  = 'asc';
    public const SORT_DESCENDING = 'desc';

    /**
     * @return array a hash that associates a field (any string) to a sort
     *               direction. The order of fields inside the array matters
     */
    public function sortSpecification(): array;

    /**
     * @param mixed      $keyset
     * @param array|null $sorting
     */
    public function getPage($keyset, ?array $sorting = null): KeysetPageResult;
}
