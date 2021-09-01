<?php
declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class RayTest extends TestCase
{
    function test_new_screen()
    {
        ray()->newScreen();

        $this->assertTrue(true);
    }

    function test_clear_all()
    {
        ray()->clearAll();

        $this->assertTrue(true);
    }

    function test_log()
    {
        ray('Hello', 'World');

        ray(['an array']);

        ray(true, false);

        ray(ray());

        ray(['a' => 1, 'b' => ['c' => 3]]);

        $this->assertTrue(true);
    }

    function test_colors()
    {
        ray('this is green')->green();
        ray('this is orange')->orange();
        ray('this is red')->red();
        ray('this is blue')->blue();
        ray('this is purple')->purple();
        ray('this is gray')->gray();

        $this->assertTrue(true);
    }

    function test_sizes()
    {
        ray('small')->small();
        ray('regular');
        ray('large')->large();

        $this->assertTrue(true);
    }

    function test_labels()
    {
        ray(['John', 'Paul', 'George', 'Ringo'])->label('Beatles');

        $this->assertTrue(true);
    }

    function test_new_screen_with_name()
    {
        ray()->newScreen('My debug screen');

        $this->assertTrue(true);
    }

    function test_caller()
    {
        ray()->caller();

        $this->assertTrue(true);
    }

    function test_trace()
    {
        ray()->trace();

        $this->assertTrue(true);
    }

    function test_pause()
    {
        ray()->pause();

        $this->assertTrue(true);
    }

    function test_count()
    {
        foreach (range(1, 2) as $i) {
            ray()->count();

            foreach (range(1, 4) as $j) {
                ray()->count();
            }
        }

        $this->assertTrue(true);
    }

    function test_count_with_name()
    {
        foreach (range(1, 4) as $i) {
            ray()->count('first');

            foreach (range(1, 2) as $j) {
                ray()->count('first');

                ray()->count('second');
            }
        }

        $this->assertTrue(true);
    }

    function test_limit()
    {
        foreach (range(1, 10) as $i) {
            ray()->limit(3)->text("A #{$i}"); // counts to 3
            ray()->limit(6)->text("B #{$i}"); // counts to 6
            ray()->text("C #{$i}"); // counts to 10
        }

        $this->assertTrue(true);
    }

    function test_class_name()
    {
        ray()->className($this);

        $this->assertTrue(true);
    }

    function test_measure()
    {
        ray()->measure();

        sleep(1);

        ray()->measure();

        sleep(2);

        ray()->measure();

        $this->assertTrue(true);
    }

    function test_json()
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

        $this->assertTrue(true);
    }

    function test_xml()
    {
        ray()->xml(
            '<one><two><three>3</three></two></one>'
        );

        $this->assertTrue(true);
    }

    function test_carbon()
    {
        ray()->carbon(new \Carbon\Carbon());

        $this->assertTrue(true);
    }

    function test_file()
    {
        ray()->file(base_path('.env'));

        $this->assertTrue(true);
    }

    function test_table()
    {
        ray()->table([
            'First' => 'First value',
            'Second' => 'Second value',
            'Third' => 'Third value',
        ]);

        ray()->table(['John', 'Paul', 'George', 'Ringo'], 'Beatles');

        $this->assertTrue(true);
    }

    function test_images()
    {
        ray()->image('https://placekitten.com/200/300');

        $this->assertTrue(true);
    }

    function test_html()
    {
        ray()->html('<b>Bold string<b>');

        $this->assertTrue(true);
    }

    function test_text()
    {
        ray()->text('<em>this string is html encoded</em>');
        ray()->text('  whitespace formatting' . PHP_EOL . '   is preserved as well.');

        $this->assertTrue(true);
    }

    function test_hide()
    {
        ray($this)->hide();

        $this->assertTrue(true);
    }

    function test_notify()
    {
        ray()->notify('This is my notification');

        $this->assertTrue(true);
    }

    function test_phpinfo()
    {
        ray()->phpinfo();

        $this->assertTrue(true);
    }

    function test_exception()
    {
        try {
            throw new \Exception('Something went wrong');
        } catch(\Exception $e) {
            ray()->exception($e);
        }

        $this->assertTrue(true);
    }

    function test_markdown()
    {
        ray()->markdown('# Hello World');

        $this->assertTrue(true);
    }
}
