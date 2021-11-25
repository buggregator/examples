<?php
declare(strict_types=1);

namespace App\Modules\Ray;

trait RayCommon
{
    /** @test */
    function rayNewScreen()
    {
        ray()->newScreen();
    }

    /** @test */
    function rayNewScreenWithName()
    {
        ray()->newScreen('My debug screen');
    }

    /** @test */
    function rayClearAll()
    {
        ray()->clearAll();
    }

    /** @test */
    function rayClearScreen()
    {
        ray()->clearScreen();
    }

    /** @test */
    function rayInt()
    {
        ray(...range(0, 9));
    }

    /** @test */
    function rayString()
    {
        ray('Hello', 'World');
    }

    /** @test */
    function rayArray()
    {
        ray(['a' => 1, 'b' => ['c' => 3]]);
    }

    /** @test */
    function rayBool()
    {
        ray(true, false);
    }

    /** @test */
    function rayObject()
    {
        ray(ray());
    }

    /** @test */
    function rayColors()
    {
        ray('this is green')->green();
        ray('this is orange')->orange();
        ray('this is red')->red();
        ray('this is blue')->blue();
        ray('this is purple')->purple();
        ray('this is gray')->gray();
    }

    /** @test */
    function raySizes()
    {
        ray('small')->small();
        ray('regular');
        ray('large')->large();
    }

    /** @test */
    function rayLabels()
    {
        ray(['John', 'Paul', 'George', 'Ringo'])->label('Beatles');
    }

    /** @test */
    function rayCaller()
    {
        ray()->caller();
    }

    /** @test */
    function rayTrace()
    {
        ray()->trace();
    }

    /** @test */
    function rayPause()
    {
        ray()->pause();
    }

    /** @test */
    function rayCounter()
    {
        foreach (range(1, 2) as $i) {
            ray()->count();

            foreach (range(1, 4) as $j) {
                ray()->count();
            }
        }
    }

    /** @test */
    function rayCounterWithName()
    {
        foreach (range(1, 4) as $i) {
            ray()->count('first');

            foreach (range(1, 2) as $j) {
                ray()->count('first');

                ray()->count('second');
            }
        }
    }

    /** @test */
    function rayLimit()
    {
        foreach (range(1, 10) as $i) {
            ray()->limit(3)->text("A #{$i}"); // counts to 3
            ray()->limit(6)->text("B #{$i}"); // counts to 6
            ray()->text("C #{$i}"); // counts to 10
        }
    }

    /** @test */
    function rayClassName()
    {
        ray()->className($this);
    }

    /** @test */
    function rayMeasure()
    {
        ray()->measure();

        sleep(1);

        ray()->measure();

        sleep(2);

        ray()->measure();
    }

    /** @test */
    function rayJson()
    {
        ray()->toJson(['a' => 1, 'b' => ['c' => 3]]);

        // all of these will be displayed in Ray
        $object = new \stdClass();
        $object->company = 'Spatie';

        ray()->toJson(
            ['a' => 1, 'b' => ['c' => 3]],
            ['d' => ['e' => 5]],
            $object
        );

        ray()->json(
            json_encode(['a' => 1, 'b' => ['c' => 3]])
        );
    }

    /** @test */
    function rayXml()
    {
        ray()->xml(
            '<one><two><three>3</three></two></one>'
        );
    }

    /** @test */
    function rayCarbon()
    {
        ray()->carbon(new \Carbon\Carbon());
    }

    /** @test */
    function rayFile()
    {
        ray()->file(base_path('.env'));
    }

    /** @test */
    function rayTable()
    {
        ray()->table([
            'First' => 'First value',
            'Second' => 'Second value',
            'Third' => 'Third value',
        ]);

        ray()->table(['John', 'Paul', 'George', 'Ringo'], 'Beatles');
    }

    /** @test */
    function rayImage()
    {
        ray()->image('https://placekitten.com/200/300');
    }

    /** @test */
    function rayHtml()
    {
        ray()->html('<b>Bold string<b>');
    }

    /** @test */
    function rayText()
    {
        ray()->text('<em>this string is html encoded</em>');
        ray()->text('  whitespace formatting' . PHP_EOL . '   is preserved as well.');
    }

    /** @test */
    function rayHide()
    {
        ray($this)->hide();
    }

    /** @test */
    function rayNotify()
    {
        ray()->notify('This is my notification');
    }

    /** @test */
    function rayPhpinfo()
    {
        ray()->phpinfo();
    }

    /** @test */
    function rayException()
    {
        try {
            throw new \Exception('Something went wrong');
        } catch (\Exception $e) {
            ray()->exception($e);
        }
    }

    /** @test */
    function rayMarkdown()
    {
        ray()->markdown('# Hello World');
    }
}
