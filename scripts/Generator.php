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
use cebe\openapi\spec\Reference;
use Eureka\Component\Console\AbstractScript;
use Eureka\Component\Console\Help;
use Eureka\Component\Console\Option\Option;
use Eureka\Component\Console\Option\Options;
use PhpParser\BuilderFactory;
use Velkuns\ArtifactsMMO\Builder\BodyVOBuilder;
use Velkuns\ArtifactsMMO\Builder\ClientBuilder;
use Velkuns\ArtifactsMMO\Builder\Enum\OperationType;
use Velkuns\ArtifactsMMO\Builder\FormatterBuilder;
use Velkuns\ArtifactsMMO\Builder\Traits\HelperTrait;
use Velkuns\ArtifactsMMO\Builder\VOBuilder;

class Generator extends AbstractScript
{
    use HelperTrait;

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
                    ),
                ),
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

        $clientBuilder    = new ClientBuilder(new BuilderFactory());
        $formatterBuilder = new FormatterBuilder(new BuilderFactory());
        $voBuilder        = new VOBuilder(new BuilderFactory());
        $bodyVoBuilder    = new BodyVOBuilder(new BuilderFactory());

        $openapi = Reader::readFromJsonFile((string) \realpath($file));
        $paths   = $openapi->paths->getPaths();
        foreach ($paths as $path => $pathItem) {
            $clientBuilder->add($path, $pathItem);
        }

        foreach ($paths as $pathItem) {
            foreach (OperationType::cases() as $operationType) {
                if (empty($pathItem->{$operationType->value})) {
                    continue;
                }

                $operation = $pathItem->{$operationType->value};

                ['schema' => $schema, 'type' => $type, 'return' => $return] = $this->getInfo($operation);
                if (empty($schema) || $schema instanceof Reference) {
                    var_dump($schema);
                    throw new \UnexpectedValueException('Only Schema type is supported!');
                }
                $formatterBuilder->add($schema, $return, $type);
                $voBuilder->add($schema, $return);

                ['schema' => $schema, 'return' => $return] = $this->getBodyInfo($operation);
                if (empty($schema) || $schema instanceof Reference) {
                    continue;
                }
                $bodyVoBuilder->add($schema, $return);
            }
        }

        $clientBuilder->generate();
        $formatterBuilder->generate();
        $voBuilder->generate();
        $bodyVoBuilder->generate();
    }
}
