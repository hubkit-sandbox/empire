<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface as Container;
use Rollerworks\Component\Version\Version;

return function (Container $container, Version $version, string $branch, ?string $releaseTitle, string $changelog) {
    $container->get('style')->info('Pre release script is successfully run.');
};
