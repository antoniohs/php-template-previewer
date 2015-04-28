<?php
namespace antonienko\PhpTempPrev\tests;

use antonienko\PhpTempPrev\Previewer;
use antonienko\PhpTempPrev\FrameworkStrategies\IFrameworkStrategy;
use stdClass;

class PreviewerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  IFrameworkStrategy|\PHPUnit_Framework_MockObject_MockObject */
    protected $strategyDouble;
    /** @var  Previewer */
    protected $sut;

    public function setUp()
    {
        parent::setUp();
        $this->strategyDouble = $this->getMockBuilder('\antonienko\PhpTempPrev\FrameworkStrategies\IFrameworkStrategy')->getMock();
        $this->sut = new Previewer($this->strategyDouble);
    }


    public function test_render_withProperArguments_properCallToStrategy()
    {
        $object_var = new stdClass();
        $object_var->property1 = 1;
        $object_var->property2 = '2842';

        $view_name = 'azofaifa';
        $expected_array_vars = [
            'var1' => 1.3892,
            'var2' => 'this is a string',
            'var3' => ['ldkjsf', 398],
            'var4' => ['elem1' => 'ldkjsf', 'elem2' => 398],
            'var5' => $object_var
        ];

        $ini_file = __DIR__.'/../fixtures/testvars.ini';
        $this->strategyDouble->expects($this->once())
            ->method('renderView')
            ->with($view_name, $expected_array_vars);
        $this->sut->render($view_name, $ini_file);
    }
}