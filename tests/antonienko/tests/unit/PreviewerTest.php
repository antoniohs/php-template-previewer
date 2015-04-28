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
        $expected_array_vars = $this->getExpectedVarsIniFile1();

        $view_name = 'azofaifa';
        $ini_file = __DIR__.'/../fixtures/testvars.ini';
        $this->strategyDouble->expects($this->once())
            ->method('renderView')
            ->with($view_name, $expected_array_vars);
        $this->sut->render($view_name, $ini_file);
    }

    public function test_render_withMoreThanOneIniFile_properCallToStrategy()
    {
        $view_name = 'azofaifa';
        $ini_file1 = __DIR__.'/../fixtures/testvars.ini';
        $ini_file2 = __DIR__.'/../fixtures/testvars2.ini';
        $expected_vars = $this->getExpectedVarsIniFile1();
        $expected_vars = array_merge(
            $expected_vars,
            [
                'var7' => 'lsdfklsdf',
                'var1' => '1.3849',
                'var8' => ['elem1' => 'ldkjsf', 'elem2' => 398],
            ]
        );
        $this->strategyDouble->expects($this->once())
            ->method('renderView')
            ->with($view_name, $expected_vars);
        $this->sut->render($view_name, [$ini_file1, $ini_file2]);
    }

    /**
     * @return array
     */
    protected function getExpectedVarsIniFile1()
    {
        $object_var = new stdClass();
        $object_var->property1 = 1;
        $object_var->property2 = '2842';

        $expected_array_vars = [
            'var1' => 1.3892,
            'var2' => 'this is a string',
            'var3' => ['ldkjsf', 398],
            'var4' => ['elem1' => 'ldkjsf', 'elem2' => 398],
            'var5' => $object_var
        ];
        return $expected_array_vars;
    }

    public function test_render_calledWithAnInvalidIniFile_throw()
    {
        $this->setExpectedException('\antonienko\PhpTempPrev\Exceptions\InvalidIniFileException');
        $this->sut->render('sdkfdsj', 'nonExistingFile');
    }

    public function test_render_withoutSettingValues_callStrategyWithEmptyArray()
    {
        $view_name = 'slskdfj';
        $this->strategyDouble->expects($this->once())
            ->method('renderView')
            ->with($view_name, array());
        $this->sut->render($view_name);
    }
}