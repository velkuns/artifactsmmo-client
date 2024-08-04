<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Velkuns\ArtifactsMMO\Script;

use cebe\openapi\exceptions\IOException;
use cebe\openapi\exceptions\TypeErrorException;
use cebe\openapi\exceptions\UnresolvableReferenceException;
use cebe\openapi\json\InvalidJsonPointerSyntaxException;
use cebe\openapi\Reader;
use cebe\openapi\spec\PathItem;
use Eureka\Component\Console\AbstractScript;
use Eureka\Component\Console\Color\Bit8StandardColor;
use Eureka\Component\Console\Help;
use Eureka\Component\Console\Option\Option;
use Eureka\Component\Console\Option\Options;
use Eureka\Component\Console\Style\Style;
use PhpParser\BuilderFactory;
use Velkuns\ArtifactsMMO\Generator\ClientGenerator;

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

    /**
     * @throws IOException
     * @throws TypeErrorException
     * @throws UnresolvableReferenceException
     * @throws InvalidJsonPointerSyntaxException
     */
    public function run(): void
    {
        $file = \trim((string) $this->options()->value('f', 'file'));
        if (!\file_exists($file)) {
            throw new \UnexpectedValueException('Cannot found file');
        }

        $openapi = Reader::readFromJsonFile((string) \realpath($file));

        $paths = $openapi->paths->getPaths();
        /** @var PathItem $pathItem */
        $pathItem  = reset($paths);
        $path      = key($paths);

        (new ClientGenerator(new BuilderFactory()))->generate($path, $pathItem);
    }
}
