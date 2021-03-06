<?php

namespace Doctrine\Bundle\PHPCRBundle\Command;

use PHPCR\Util\Console\Command\WorkspaceListCommand as BaseWorkspaceListCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Wrapper to use this command in the symfony console with multiple sessions.
 */
class WorkspaceListCommand extends BaseWorkspaceListCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('doctrine:phpcr:workspace:list')
            ->addOption('session', null, InputOption::VALUE_OPTIONAL, 'The session to use for this command')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        DoctrineCommandHelper::setApplicationPHPCRSession(
            $this->getApplication(),
            $input->getOption('session'),
            true
        );

        return parent::execute($input, $output);
    }
}
