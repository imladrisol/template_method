<?php

abstract class AbstractClass
{
    public $file;
    public $handle;
    final public function templateMethod($file): void
    {
        $this->file = $file;
        $this->openFile();
        $this->saveToFile();
        $this->closeFile();
    }

    protected function openFile(): void
    {
        echo "Open file\n";
        $this->handle = fopen($this->file, "a+");
    }

    protected function closeFile(): void
    {
        echo "close file\n";
        fclose($this->handle);
    }

    abstract protected function saveToFile(): void;
}

class SaveDateToFile extends AbstractClass
{
    protected function saveToFile(): void
    {
        echo "write current date to file\n";
        fwrite($this->handle, date('l jS \of F Y h:i:s A'));
    }
}

class SaveTimeToFile extends AbstractClass
{
    protected function saveToFile(): void
    {
        echo "write current time to file\n";
        fwrite($this->handle, date("H:i:s"));
    }
}

function clientCode(AbstractClass $class, $file)
{
    $class->templateMethod($file);
}
$file = '1.txt';
clientCode(new SaveDateToFile, $file);
echo "\n";

clientCode(new SaveTimeToFile, $file);