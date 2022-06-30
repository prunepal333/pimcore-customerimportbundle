<?php
namespace App\Service;
class SlugGenerator
{ 
    public function generate($string): string
    {
        $slug = preg_replace('/\s+/', '-', $string);
        // $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
    }
    /*
        I could have use PHPUnit for testing, But I am Messy and You Know!
    */
    // public static function test()
    // {
    //     $sg = new SlugGenerator;
    //     var_dump($sg->generate("I am a boy!"));
    //     var_dump($sg->generate("I am a  very egoistic   person...!!!"));
    // }
}
// SlugGenerator::test();