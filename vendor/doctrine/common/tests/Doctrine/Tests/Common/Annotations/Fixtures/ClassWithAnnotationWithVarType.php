<?php

namespace Doctrine\Tests\Common\Annotations\Fixtures;

class ClassWithAnnotationWithVarType
{
    /**
     * @AnnotationWithVarType(string = "String Value")
     */
    public $foo;

    /**
     * @AnnotationWithVarType(annotation = @AnnotationTargetAll)
     */
    public function bar()
    {
    }


    /**
     * @AnnotationWithVarType(string = 123)
     */
    public $invalidProperty;

    /**
     * @AnnotationWithVarType(annotation = @AnnotationTargetAnnotation)
     */
    public function invalidMethod()
    {
    }
}