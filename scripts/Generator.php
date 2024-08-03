<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\Component\ArtifactsMMO\Script;

use Eureka\Component\Console\AbstractScript;
use Eureka\Component\Console\Color\Bit8StandardColor;
use Eureka\Component\Console\Help;
use Eureka\Component\Console\Option\Option;
use Eureka\Component\Console\Option\Options;
use Eureka\Component\Console\Style\Style;

class Generator extends AbstractScript
{
    public function __construct(
    ) {
        $this->setDescription('Orm generator');
        $this->setExecutable();

        $this->initOptions(
            (new Options())
                ->add(
                    new Option(
                        shortName: 'f',
                        longName: 'file',
                        description: 'OpenAPI file to process',
                        mandatory: true,
                        hasArgument: true,
                    )
                )
        );
    }

    public function help(): void
    {
        (new Help('...', $this->declaredOptions(), $this->output(), $this->options()))->display();
    }

    public function run(): void
    {
        $file = trim((string) $this->options()->value('f', 'file'));

        // TODO STUFF
    }
}
