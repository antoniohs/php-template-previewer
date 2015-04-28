<?php
namespace antonienko\PhpTempPrev\tests;


use antonienko\PhpTempPrev\FrameworkStrategies\PhalconStrategy;
use stdClass;

class PhalconStrategyTest extends \PHPUnit_Framework_TestCase
{
    /** @var  PhalconStrategy */
    protected $sut;
    /** @var  \Phalcon\Mvc\View|\PHPUnit_Framework_MockObject_MockObject */
    protected $viewDouble;

    public function setUp()
    {
        $this->viewDouble = $this->getMockBuilder('\Phalcon\Mvc\View')->getMock();
        $this->sut = new PhalconStrategy($this->viewDouble);
        parent::setUp();
    }

    public function test_renderView_calledWithCorrectArguments_properCallToViewSetVar()
    {
        $object_var = new stdClass();
        $object_var->property1 = 1;
        $object_var->property2 = '2842';

        $vars = [
            'int_var'    => 13,
            'string_var' => 'azofaifa',
            'array_var'  => [0 => '2834', '4389' => 31],
            'object_var' => $object_var
        ];
        $this->viewDouble->expects($this->exactly(4))
            ->method('setVar')
            ->withConsecutive(
                ['int_var', 13],
                ['string_var', 'azofaifa'],
                ['array_var', [0 => '2834', '4389' => 31]],
                ['object_var', $object_var]
            );
        $this->sut->renderView('viewName', $vars);
    }

    public function test_renderView_calledWithCorrectArguments_properCallToViewPick()
    {
        $view_name = 'viewName';
        $this->viewDouble->expects($this->once())
            ->method('pick')
            ->with($view_name);
        $this->sut->renderView($view_name, array());
    }
}