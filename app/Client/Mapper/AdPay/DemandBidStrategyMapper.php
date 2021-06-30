<?php

/*
 * Copyright (c) 2018-2021 Adshares sp. z o.o.
 *
 * This file is part of AdServer
 *
 * AdServer is free software: you can redistribute and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * AdServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with AdServer. If not, see <https://www.gnu.org/licenses/>
 */

declare(strict_types=1);

namespace Adshares\Adserver\Client\Mapper\AdPay;

use Adshares\Adserver\Models\BidStrategy;
use Illuminate\Support\Collection;

class DemandBidStrategyMapper
{
    public static function mapBidStrategyCollectionToArray(Collection $bidStrategies): array
    {
        return $bidStrategies->map(
            function (BidStrategy $bidStrategy) {
                return [
                    'id' => $bidStrategy->uuid,
                    'name' => $bidStrategy->name,
                    'details' => $bidStrategy->bidStrategyDetails->toArray(),
                ];
            }
        )->toArray();
    }

    public static function mapBidStrategyCollectionToIds(Collection $bidStrategies): array
    {
        $bidStrategyIds = [];
        foreach ($bidStrategies as $bidStrategy) {
            /** @var $bidStrategy BidStrategy */
            $bidStrategyIds[] = $bidStrategy->uuid;
        }

        return $bidStrategyIds;
    }
}
