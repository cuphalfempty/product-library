<?php
/**
 * GeneralProductTest.php.
 * Version: 1.0.0 (11/09/19)
 * Copyright: Freetimers Internet
 * Author:   Dean Haines
 */


namespace src\Product;


use PHPUnit\Framework\TestCase;
use Vbpupil\Collection\Collection;
use vbpupil\Product\GeneralProduct;
use vbpupil\Variation\SimpleVariation;

class GeneralProductTest extends TestCase
{
    protected $sut;


    public function setUp()
    {
        $this->description = $this->getMockBuilder(Collection::class)
            ->setMethods(['addItem', 'getItems'])
            ->getMock();

        $this->variations = $this->getMockBuilder(Collection::class)
            ->setMethods(['addItem', 'getItems'])
            ->getMock();


        $this->simpleVariation = $this->getMockBuilder(SimpleVariation::class)
            ->disableOriginalConstructor()
            ->setMethods(['addItem', 'getItems'])
            ->getMock();

        $this->sut = new GeneralProduct(
            'Sony PS4 With 1 Controller',
            $this->description,
            true
        );
    }

    public function testNewingUpAProduct()
    {
        $this->assertTrue($this->sut instanceof GeneralProduct);
    }

    public function testAddingVariations()
    {
        $this->variations
            ->expects($this->once())
            ->method('getItems')
            ->will($this->returnValue(
                [$this->simpleVariation]
            ));

        $this->sut->setVariations(
            $this->variations
        );
    }

    public function testWrongTypeAdded()
    {
        try {
            $this->variations
                ->expects($this->once())
                ->method('getItems')
                ->will($this->returnValue(
                    ['test', 'test2']
                ));

            $this->sut->setVariations(
                $this->variations
            );
        }catch(\Exception $e){
//            echo $e->getMessage();
            $this->assertEquals('Incompatible type, must be/extend from SimpleVariation', $e->getMessage());
        }
    }
}