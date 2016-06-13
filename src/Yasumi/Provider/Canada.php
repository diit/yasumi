<?php
/**
 *  This file is part of the Yasumi package.
 *
 *  Copyright (c) 2015 - 2016 AzuyaLabs
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <stelgenhof@gmail.com>
 */

namespace Yasumi\Provider;

use DateTime;
use DateTimeZone;
use Yasumi\Holiday;

/**
 * Provider for all holidays in Canada.
 */
class France extends AbstractProvider
{
    use CommonHolidays, ChristianHolidays;

    /**
     * Code to identify this Holiday Provider. Typically this is the ISO3166 code corresponding to the respective
     * country or subregion.
     */
    const ID = 'CA';

    /**
     * Initialize holidays for France.
     */
    public function initialize()
    {
        $this->timezone = 'America/Toronto';

        // Add common holidays
        $this->addHoliday($this->newYearsDay($this->year, $this->timezone, $this->locale));

        // Add Christian holidays
        $this->addHoliday($this->easterMonday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->goodFriday($this->year, $this->timezone, $this->locale));
        $this->addHoliday($this->christmasDay($this->year, $this->timezone, $this->locale));

        /*
         * Canada Day.
         *
         * Canada Day (French: Fête du Canada) is the national day of Canada, a federal statutory 
         * holiday celebrating the anniversary of the July 1, 1867, enactment of the Constitution 
         * Act, 1867 (then called the British North America Act, 1867), which united three colonies 
         * into a single country called Canada within the British Empire.[1][2][3] Originally called 
         * Dominion Day (French: Le Jour de la Confédération), the holiday was renamed in 1982, the 
         * year the Canada Act was passed. Canada Day observances take place throughout Canada as 
         * well as among Canadians internationally.
         *
         * @link http://en.wikipedia.org/wiki/Canada_Day
         */
        if ($this->year >= 1867) {
            $this->addHoliday(new Holiday('canadaDay', [
                'en_US' => 'Canada Day',
                'fr_CA' => 'Fête du Canada',
            ], new DateTime("$this->year-7-1", new DateTimeZone($this->timezone)), $this->locale));
        }

        /* 
         * Labour Day
         *
         * Celebrates economic and social achievements of workers.
         */
        $this->addHoliday(new Holiday('labourDay', [
            'en_US' => 'Labour Day',
            'fr_CA' => 'Fête du travail',
        ], new DateTime("first monday of september $this->year", new DateTimeZone($this->timezone)), $this->locale));

        /*
         * Victoria Day.
         *
         * Victoria Day (in French: Fête de la Reine) is a federal Canadian public holiday 
         * celebrated on the last Monday preceding May 25, in honour of Queen Victoria's 
         * birthday. As such, it is the Monday between the 18th to the 24th inclusive, and 
         * thus is always the penultimate Monday of May. The date is simultaneously that 
         * on which the current Canadian sovereign's official birthday is recognized. It 
         * is sometimes informally considered the beginning of the summer season in Canada. 
         * 
         * The holiday has been observed in Canada since at least 1845, originally falling 
         * on Victoria's actual birthday. It continues to be celebrated in various fashions 
         * across the country; the holiday has always been a distinctly Canadian observance. 
         * Victoria Day is a federal statutory holiday, as well as a holiday in six of Canada's 
         * ten provinces and all three of its territories. In Quebec, before 2003, the Monday 
         * preceding 25 May of each year was unofficially the Fête de Dollard, a commemoration 
         * initiated in the 1920s to coincide with Victoria Day. In 2003, provincial legislation 
         * officially created National Patriots' Day on the same date.
         *
         * @link http://en.wikipedia.org/wiki/Victoria_Day
         */
        $this->addHoliday(new Holiday('victoriaDay', [
            'en_US' => 'Victoria Day',
            'fr_CA' => 'Fête de la Reine ou Journée nationale des Patriotes',
        ], new DateTime("monday on or before may 24 $this->year", new DateTimeZone($this->timezone)), $this->locale));
    }
}
