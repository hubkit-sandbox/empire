<?php

declare(strict_types=1);

/*
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace ParkManager\Module\CoreModule\Infrastructure\Mailer\Sender;

use ParkManager\Module\CoreModule\Application\Service\Mailer\RecipientEnvelope;

interface Sender
{
    public function send(string $template, array $variables, RecipientEnvelope ...$recipients): void;

    /**
     * @param Attachment[] $attachments
     */
    public function sendWithAttachments(string $template, array $variables, array $attachments, RecipientEnvelope ...$recipients): void;
}
