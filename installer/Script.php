<?php

declare(strict_types=1);
/**
 * This file is part of MoChat.
 * @link     https://mo.chat
 * @document https://mochat.wiki
 * @contact  group@mo.chat
 * @license  https://github.com/mochat-cloud/mochat/blob/master/LICENSE
 */
namespace Installer;

use Composer\Script\Event;

class Script
{
    public static function install(Event $event)
    {
        $installer = new OptionalPackages($event->getIO(), $event->getComposer());

        $installer->io->write('<info>正在创建 MoChat 插件，请根据以下提示进行配置</info>');

        $installer->setUpComposerJson();
        $installer->mkdir();
        $installer->removeDevDependencies();
        $installer->promptForOptionalPackages();
        $installer->updateRootPackage();
        $installer->removeInstallerFromDefinition();
        $installer->finalizePackage();
    }

    public static function cleanUp(Event $event)
    {
        $installer = new OptionalPackages($event->getIO(), $event->getComposer());
        $installer->cleanUp();
        $installer->io->write('<info>恭喜，MoChat 插件创建成功！</info>');

    }
}