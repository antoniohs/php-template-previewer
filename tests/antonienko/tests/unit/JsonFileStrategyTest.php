<?php
namespace antonienko\PhpTempPrev\tests;


use antonienko\PhpTempPrev\FileStrategies\JsonFileStrategy;

class JsonFileStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function test_extractVars_calledWithProperArguments_returnProperVars()
    {
        $json_file1 = __DIR__.'/../fixtures/testvars.json';
        $json_file2 = __DIR__.'/../fixtures/testvars2.json';

        $sut = new JsonFileStrategy([$json_file1, $json_file2]);

        $object_var = new \stdClass();
        $object_var->property1 = 1;
        $object_var->property2 = '2842';
        $expected = [
            'var1' => '1.3849',
            'var2' => 'this is a string',
            'var3' => ['ldkjsf', 398],
            'var4' => ['elem1' => 'ldkjsf', 'elem2' => 398],
            'var5' => $object_var,
            'var7' => 'lsdfklsdf',
            'var8' => ['elem1' => 'ldkjsf', 'elem2' => 398],
        ];
        $actual = $sut->extractVars();
        $this->assertEquals($expected, $actual);
    }
}