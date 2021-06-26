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

namespace Sonata\AdminBundle\Tests\Event;

use PHPUnit\Framework\TestCase;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Event\PersistenceEvent;

class PersistenceEventTest extends TestCase
{
    /**
     * @var PersistenceEvent<object>
     */
    private $event;

    /**
     * @var AdminInterface<object>
     */
    private $admin;

    /**
     * @var object
     */
    private $object;

    protected function setUp(): void
    {
        /** @var object $object */
        $object = new \stdClass();

        $this->admin = $this->createMock(AdminInterface::class);
        $this->object = $object;

        $this->event = new PersistenceEvent($this->admin, $this->object, 'Foo');
    }

    public function testGetType(): void
    {
        $this->assertSame('Foo', $this->event->getType());
    }

    public function testGetAdmin(): void
    {
        $result = $this->event->getAdmin();

        $this->assertInstanceOf(AdminInterface::class, $result);
        $this->assertSame($this->admin, $result);
    }

    public function testGetObject(): void
    {
        $this->assertSame($this->object, $this->event->getObject());
    }
}
