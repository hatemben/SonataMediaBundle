<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\MediaBundle\Admin\PHPCR;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\MediaBundle\Admin\BaseMediaAdmin as Admin;

/**
 * @final since sonata-project/media-bundle 3.21.0
 */
class MediaAdmin extends Admin
{
    /**
     * Path to the root node of media documents.
     *
     * @var string
     */
    protected $root;

    /**
     * @param string $root
     */
    public function setRoot($root): void
    {
        $this->root = $root;
    }

    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $query = $this->getModelManager()->createQuery($this->getClass(), 'a', $this->root);

        foreach ($this->extensions as $extension) {
            $extension->configureQuery($this, $query, $context);
        }

        return $query;
    }

    /**
     * {@inheritdoc}
     */
    public function id($object)
    {
        return $this->getUrlsafeIdentifier($object);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        // TODO disabled filter due to no attached service for filter types: string, checkbox
//        $datagridMapper
//            ->add('name')
//            ->add('providerReference')
//            ->add('enabled')
//            ->add('context')
//        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection): void
    {
        // Allow path in id parameter
        $collection->add('view', $this->getRouterIdParameter().'/view', [], ['id' => '.+', '_method' => 'GET']);
        $collection->add('show', $this->getRouterIdParameter().'/show', [
                '_controller' => sprintf('%s:%s', $this->baseControllerName, 'view'),
            ],
            ['id' => '.+', '_method' => 'GET']
        );
    }
}
