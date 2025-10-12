<?php

namespace App\Modules\BaseModule;

use Illuminate\Support\Str;

class Module
{

    public mixed $data;
    public function setOutput(string $output): void
    {
        // TODO: Implement setOutput() method.
    }

    public function getModuleName(): string
    {
        $class = new \ReflectionClass($this);
        return $class->getShortName();
    }

    public function setModuleName(string $moduleName): void
    {
        // TODO: Implement setModuleName() method.
    }

    public function getModulePath(): string
    {
        $class = new \ReflectionClass($this);
        $namespace = $class->getNamespaceName();
        $className = $class->getShortName();
        if (Str::endsWith($className, 'Module')) {
            $className = substr($className, 0, -6);
        }
        $namespace = Str::replace('App\Modules\\', '', $namespace);
        $fullName = $namespace . '\\' . $className;
        $snake_name = Str::snake($fullName);
        return Str::replace('\_', '.', $snake_name);
    }


    public function setModulePath(string $modulePath): void
    {
        // TODO: Implement setModulePath() method.
    }

}
