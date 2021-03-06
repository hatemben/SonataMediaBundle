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

namespace Sonata\MediaBundle\Document;

use Sonata\Doctrine\Document\BaseDocumentManager;
use Sonata\MediaBundle\Model\GalleryInterface;
use Sonata\MediaBundle\Model\GalleryManagerInterface;

/**
 * @final since sonata-project/media-bundle 3.21.0
 */
class GalleryHasMediaManager extends BaseDocumentManager implements GalleryManagerInterface
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('attachment', 'file')
        ;
    }
}