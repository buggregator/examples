<?php

declare(strict_types=1);

namespace App\Modules\Ray;

use App\RandomPhraseGenerator;

trait RayCommon
{
    /** @test */
    function rayNewScreen(): void
    {
        ray()->newScreen();
    }

    /** @test */
    function rayNewScreenWithName(): void
    {
        ray()->newScreen('My debug screen');
    }

    /** @test */
    function rayClearAll(): void
    {
        ray()->clearAll();
    }

    /** @test */
    function rayClearScreen(): void
    {
        ray()->clearScreen();
    }

    /** @test */
    function rayInt(): void
    {
        ray(4, 8, 15, 16, 23, 42);
    }

    /** @test */
    function rayString(RandomPhraseGenerator $generator): void
    {
        ray('Here is a random phrase', $generator->generate('Buggregator'));
    }

    /** @test */
    function rayArray(): void
    {
        ray(['a' => 4, 'b' => ['c' => 8, 'd' => 15], 'e' => [16, 23, 42]]);
    }

    /** @test */
    function rayBool(): void
    {
        ray(true, false);
    }

    /** @test */
    function rayObject(RandomPhraseGenerator $generator): void
    {
        $object = new \stdClass();
        $object->name = 'Buggregator';
        $object->funnyFact = $generator->generate('Buggregator');
        ray($object);

        ray(ray());
    }

    /** @test */
    function rayColors(): void
    {
        ray('this is green')->green();
        ray('this is orange')->orange();
        ray('this is red')->red();
        ray('this is blue')->blue();
        ray('this is purple')->purple();
        ray('this is gray')->gray();
    }

    /** @test */
    function raySizes(): void
    {
        ray('small')->small();
        ray('regular');
        ray('large')->large();
    }

    /** @test */
    function rayLabels(): void
    {
        ray(['John', 'Paul', 'George', 'Ringo'])->label('Beatles');
    }

    /** @test */
    function rayCaller(): void
    {
        ray()->caller();
    }

    /** @test */
    function rayTrace(): void
    {
        ray()->trace();
    }

    /** @test */
    function rayPause(): void
    {
        ray()->pause();
    }

    /** @test */
    function rayCounter(): void
    {
        foreach (range(1, 2) as $i) {
            ray()->count();

            foreach (range(1, 4) as $j) {
                ray()->count();
            }
        }
    }

    /** @test */
    function rayCounterWithName(): void
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
    function rayLimit(): void
    {
        foreach (range(1, 10) as $i) {
            ray()->limit(3)->text("A #{$i}"); // counts to 3
            ray()->limit(6)->text("B #{$i}"); // counts to 6
            ray()->text("C #{$i}"); // counts to 10
        }
    }

    /** @test */
    function rayClassName(): void
    {
        ray()->className($this);
    }

    /** @test */
    function rayMeasure(): void
    {
        ray()->measure();

        sleep(1);

        ray()->measure();

        sleep(2);

        ray()->measure();
    }

    /** @test */
    function rayJson(): void
    {
        ray()->toJson(['a' => 1, 'b' => ['c' => 3]]);

        // all of these will be displayed in Ray
        $object = new \stdClass();
        $object->company = 'Spatie';

        ray()->toJson(
            ['a' => 1, 'b' => ['c' => 3]],
            ['d' => ['e' => 5]],
            $object,
        );

        ray()->json(
            json_encode(['a' => 1, 'b' => ['c' => 3]]),
        );
    }

    /** @test */
    function rayXml(RandomPhraseGenerator $generator): void
    {
        ray()->xml(
            '<one><two><three>'.$generator->generate('Buggregator').'</three></two></one>',
        );
    }

    /** @test */
    function rayCarbon(): void
    {
        ray()->carbon(new \Carbon\Carbon());
    }

    /** @test */
    function rayFile(): void
    {
        ray()->file(base_path('.env'));
    }

    /** @test */
    function rayTable(): void
    {
        ray()->table([
            'First' => 'First value',
            'Second' => 'Second value',
            'Third' => 'Third value',
        ]);

        ray()->table(['John', 'Paul', 'George', 'Ringo'], 'Beatles');
    }

    /** @test */
    function rayImage(): void
    {
        ray()->image('https://placekitten.com/200/300');
    }

    /** @test */
    function rayHtml(RandomPhraseGenerator $generator): void
    {
        ray()->html('<b>'.$generator->generate('Buggregator').'<b>');
    }

    /** @test */
    function rayText(RandomPhraseGenerator $generator): void
    {
        ray()->text('<em>'.$generator->generate('Buggregator').'</em>');
        ray()->text('  whitespace formatting' . PHP_EOL . '   is preserved as well.');
    }

    /** @test */
    function rayHide(): void
    {
        ray($this)->hide();
    }

    /** @test */
    function rayNotify(): void
    {
        ray()->notify('This is my notification');
    }

    /** @test */
    function rayPhpinfo(): void
    {
        ray()->phpinfo();
    }

    /** @test */
    function rayException(RandomPhraseGenerator $generator): void
    {
        try {
            throw new \Exception($generator->generateException('Buggregator'));
        } catch (\Exception $e) {
            ray()->exception($e);
        }
    }

    /** @test */
    function rayMarkdown(RandomPhraseGenerator $generator): void
    {
        ray()->markdown('# ' . $generator->generate('Buggregator'));
    }
}
