<?php

declare(strict_types=1);

namespace Francken\Tests\Application\FranckenVrij;

use Francken\Application\FranckenVrij\Edition;
use Francken\Domain\FranckenVrij\EditionId;
use Francken\Domain\Url;
use Francken\Tests\Application\ReadModelTestCase as TestCase;

class EditionTest extends TestCase
{
    /** @test */
    function it_has_a_volume_and_edition_number()
    {
        $id = EditionId::generate();

        $edition = Edition::publish(
            $id,
            'Francken Vrij',
            20,
            1,
            new Url('http://www.professorfrancken.nl/franckenvrij/webplaatjes/20.1.jpg'),
            new Url('http://www.professorfrancken.nl/franckenvrij/20.1.pdf')
        );

        $this->assertEquals($id, $edition->getId());
        $this->assertEquals('Francken Vrij', $edition->title());
        $this->assertEquals(20, $edition->volume());
        $this->assertEquals(1, $edition->edition());
        $this->assertEquals(new Url('http://www.professorfrancken.nl/franckenvrij/20.1.pdf'), $edition->pdf());
        $this->assertEquals(new Url('http://www.professorfrancken.nl/franckenvrij/webplaatjes/20.1.jpg'), $edition->cover());
    }

    /**
     * @dataProvider editionProvider
     * @test
     */
    function the_volume_and_edition_must_be_positive(int $volume, int $edition, bool $throws = false)
    {
        $id = EditionId::generate();

        if ($throws) {
            $this->expectException(\InvalidArgumentException::class);
        }

        $edition = Edition::publish(
            $id,
            'Francken Vrij',
            $volume,
            $edition,
            new Url('http://www.professorfrancken.nl/franckenvrij/webplaatjes/20.1.jpg'),
            new Url('http://www.professorfrancken.nl/franckenvrij/20.1.pdf')
        );
    }

    function editionProvider() : array
    {
        return [
            [1, 1],
            [-1, 1, true],
            [0, 1, true],
            [1, 0, true],
            [1, -1, true],
            [1, 4, true],
        ];
    }


    protected function createInstance()
    {
        return Edition::publish(
            EditionId::generate(),
            'Francken Vrij',
            20,
            1,
            new Url('http://www.professorfrancken.nl/franckenvrij/20.1.pdf'),
            new Url('http://www.professorfrancken.nl/franckenvrij/webplaatjes/20.1.jpg')
        );
    }
}
