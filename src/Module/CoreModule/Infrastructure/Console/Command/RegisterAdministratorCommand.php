<?php

declare(strict_types=1);

/*
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at http://mozilla.org/MPL/2.0/.
 */

namespace ParkManager\Module\CoreModule\Infrastructure\Console\Command;

use InvalidArgumentException;
use ParkManager\Module\CoreModule\Application\Command\Administrator\RegisterAdministrator;
use ParkManager\Module\CoreModule\Domain\Administrator\AdministratorId;
use ParkManager\Module\CoreModule\Infrastructure\Security\AdministratorUser;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface as MessageBus;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RegisterAdministratorCommand extends Command
{
    protected static $defaultName = 'park-manager:administrator:register';

    private $validator;
    private $passwordEncoder;
    private $commandBus;

    public function __construct(ValidatorInterface $validator, EncoderFactoryInterface $passwordEncoder, MessageBus $commandBus)
    {
        parent::__construct();

        $this->validator       = $validator;
        $this->passwordEncoder = $passwordEncoder;
        $this->commandBus      = $commandBus;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Registers a new Administrator user')
            ->setHelp(<<<'EOT'
The <info>%command.name%</info> command registers a new Administrator user.
EOT
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $displayName = $io->ask('Display name');
        $email       = $io->ask('E-mail address', null, function ($value) {
            $violationList = $this->validator->validate($value, [new NotBlank(), new Email()]);

            if ($violationList->count() > 0) {
                throw new InvalidArgumentException((string) $violationList);
            }

            return $value;
        });

        $password = $this->passwordEncoder->getEncoder(AdministratorUser::class)
            ->encodePassword($io->askHidden('Password'), '');

        $this->commandBus->dispatch(
            new RegisterAdministrator(AdministratorId::create()->toString(), $email, $displayName, $password)
        );

        $io->success('Administrator was registered.');

        return 0;
    }
}
