<?php

declare(strict_types=1);

namespace Tests\Francken\Books\Events;

use Francken\Tests\Domain\EventTestCase as Testcase;
use Francken\Domain\Books\BookId;
use Francken\Domain\Books\Events\BookOfferRetracted;

class BookEventTest extends Testcase
{
    /** @test */
    public function an_event_holds_data()
    {
        $bookId = BookId::generate();

        $event = new BookOfferRetracted($bookId);

        $this->assertEquals($event->bookId(), $bookId);
    }

    protected function createInstance()
    {
        $bookId = BookId::generate();

        return new BookOfferRetracted($bookId);
    }
}
