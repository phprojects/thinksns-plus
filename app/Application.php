<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                          ThinkSNS Plus                               |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2018 Chengdu ZhiYiChuangXiang Technology Co., Ltd.     |
 * +----------------------------------------------------------------------+
 * | This source file is subject to version 2.0 of the Apache license,    |
 * | that is bundled with this package in the file LICENSE, and is        |
 * | available through the world-wide-web at the following url:           |
 * | http://www.apache.org/licenses/LICENSE-2.0.html                      |
 * +----------------------------------------------------------------------+
 * | Author: Slim Kit Group <master@zhiyicx.com>                          |
 * | Homepage: www.thinksns.com                                           |
 * +----------------------------------------------------------------------+
 */

namespace Zhiyi\Plus;

use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;

class Application extends LaravelApplication
{
    /**
     * The ThinkSNS Plus version.
     *
     * @var string
     */
    const VERSION = '1.9.0';

    /**
     * The core vendor YAML file.
     *
     * @var string.
     */
    protected $vendorYamlFile;

    /**
     * Create a new Illuminate application instance.
     *
     * @param string|null $basePath
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function __construct($basePath = null)
    {
        parent::__construct($basePath);

        // Load configuration after.
        $this->afterBootstrapping(\Illuminate\Foundation\Bootstrap\LoadConfiguration::class, function ($app) {
            $app->make(\Zhiyi\Plus\Bootstrap\LoadConfiguration::class)
                ->handle();
        });
    }

    /**
     * Get the version number of the Laravel framework.
     *
     * @return string
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function getLaravelVersion()
    {
        return parent::VERSION;
    }

    /**
     * Register the core class aliases in the container.
     *
     * @return void
     * @author Seven Du <shiweidu@outlook.com>
     */
    public function registerCoreContainerAliases()
    {
        parent::registerCoreContainerAliases();

        $aliases = [
            'app' => [static::class],
            'cdn' => [
                \Zhiyi\Plus\Contracts\Cdn\UrlFactory::class,
                \Zhiyi\Plus\Cdn\UrlManager::class,
            ],
        ];

        foreach ($aliases as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->alias($key, $alias);
            }
        }
    }

    /**
     * The app configure path.
     * @param  string $path
     * @return string
     */
    public function appConfigurePath(?string $path): string
    {
        return $this->basePath().'/storage/configure/'.($path ?: '');
    }

    /**
     * Get the app YAML configure filename.
     * @return string
     */
    public function appYamlConfigureFile(): string
    {
        return $this->appConfigurePath('plus.yml');
    }
}
