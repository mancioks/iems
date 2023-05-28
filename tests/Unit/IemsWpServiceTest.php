<?php

namespace Tests\Unit;

use App\Models\Entry;
use App\Services\IemsWp;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class IemsWpServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIemsServiceCollectionBuilder()
    {
        $entries = new Collection();
        $entry = new Entry();
        $entries->push($entry);

        $entriesCollection = IemsWp::createCollectionFromEntries($entries);

        $this->assertIsObject($entriesCollection);
        $this->assertEquals(1, $entriesCollection->count());
    }
}
