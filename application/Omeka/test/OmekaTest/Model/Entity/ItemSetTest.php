<?php
namespace OmekaTest\Model;

use Omeka\Model\Entity\Item;
use Omeka\Model\Entity\ItemSet;
use Omeka\Test\TestCase;

class ItemSetTest extends TestCase
{
    protected $itemSet;

    public function setUp()
    {
        $this->itemSet = new ItemSet;
    }

    public function testInitialState()
    {
        $this->assertNull($this->itemSet->getId());
        $this->assertNull($this->itemSet->getOwner());
        $this->assertNull($this->itemSet->getResourceClass());
        $this->assertInstanceOf(
            'Doctrine\Common\Collections\ArrayCollection',
            $this->itemSet->getSites()
        );
        $this->assertInstanceOf(
            'Doctrine\Common\Collections\ArrayCollection',
            $this->itemSet->getItems()
        );
    }

    public function testSetState()
    {
        $this->itemSet->setOwner('owner');
        $this->itemSet->setResourceClass('resource_class');
        $this->assertEquals('owner', $this->itemSet->getOwner());
        $this->assertEquals('resource_class', $this->itemSet->getResourceClass());
    }

    public function testAddItem()
    {
        $item= new Item;
        $this->itemSet->addItem($item);
        $this->assertTrue($this->itemSet->getItems()->contains($item));
    }

    public function testRemoveItem()
    {
        $item = new Item;
        $this->itemSet->addItem($item);
        $this->assertTrue($this->itemSet->removeItem($item));
    }
}
