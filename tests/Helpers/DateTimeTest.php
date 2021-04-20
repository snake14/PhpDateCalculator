<?php 
	declare(strict_types=1);

	use PHPUnit\Framework\TestCase;
	use \Helpers\DateTime;
	
	final class DateTimeTest extends TestCase {
		public function testCalcDiffBetweenDates(): void {
			$result = DateTime::calcDiffBetweenDates('2021-04-01', '2021-04-03');
			$this->assertNotEmpty($result);
			$this->assertSame('2', $result->format('%d'));
			$this->assertSame('0', $result->format('%h'));
			$this->assertSame('0', $result->format('%i'));
		}

		public function testCalcDiffBetweenDatesLongerPeriod(): void {
			$result = DateTime::calcDiffBetweenDates('2020-01-01', '2021-04-03');
			$this->assertNotEmpty($result);
			$this->assertSame('2', $result->format('%d'));
			$this->assertSame('3', $result->format('%m'));
			$this->assertSame('1', $result->format('%y'));
		}

		public function testCalculateFromDateAddDays(): void {
			$result = DateTime::calculateFromDate('2020-01-01', DateTime::OPERATION_ADD, 2, DateTime::UNIT_TYPE_DAY);
			$this->assertNotEmpty($result);
			$this->assertSame('2020-01-03', $result->format('Y-m-d'));
		}

		public function testCalculateFromDateSubtractDays(): void {
			$result = DateTime::calculateFromDate('2020-01-03', DateTime::OPERATION_SUBTRACT, 2, DateTime::UNIT_TYPE_DAY);
			$this->assertNotEmpty($result);
			$this->assertSame('2020-01-01', $result->format('Y-m-d'));
		}

		public function testCalculateFromDateAddMonths(): void {
			$result = DateTime::calculateFromDate('2020-01-01', DateTime::OPERATION_ADD, 2, DateTime::UNIT_TYPE_MONTH);
			$this->assertNotEmpty($result);
			$this->assertSame('2020-03-01', $result->format('Y-m-d'));
		}

		public function testCalculateFromDateSubtractMonths(): void {
			$result = DateTime::calculateFromDate('2020-03-01', DateTime::OPERATION_SUBTRACT, 2, DateTime::UNIT_TYPE_MONTH);
			$this->assertNotEmpty($result);
			$this->assertSame('2020-01-01', $result->format('Y-m-d'));
		}

		public function testCalculateFromDateAddYears(): void {
			$result = DateTime::calculateFromDate('2020-01-01', DateTime::OPERATION_ADD, 2, DateTime::UNIT_TYPE_YEAR);
			$this->assertNotEmpty($result);
			$this->assertSame('2022-01-01', $result->format('Y-m-d'));
		}

		public function testCalculateFromDateSubtractYears(): void {
			$result = DateTime::calculateFromDate('2020-01-01', DateTime::OPERATION_SUBTRACT, 2, DateTime::UNIT_TYPE_YEAR);
			$this->assertNotEmpty($result);
			$this->assertSame('2018-01-01', $result->format('Y-m-d'));
		}

		public function testCalculateFromDateAddHours(): void {
			$result = DateTime::calculateFromDate('2020-01-01 14:30', DateTime::OPERATION_ADD, 2, DateTime::UNIT_TYPE_HOUR);
			$this->assertNotEmpty($result);
			$this->assertSame('2020-01-01 16:30', $result->format('Y-m-d H:i'));
		}

		public function testconvertToTimeZoneInvalidToZone() {
			try {
				DateTime::convertToTimeZone('', '2021-04-16 15:25:00', 'America/Los_Angeles');
				$this->fail('This should have failed with an invalid to time zone.');
			} catch (\Throwable $th) {
				$this->assertStringContainsString("The provided to time zone '' is not a valid time zone.", $th->getMessage());
			}
		}

		public function testconvertToTimeZoneInvalidFromDate() {
			try {
				DateTime::convertToTimeZone('America/Denver', 'Meh', 'America/Los_Angeles');
				$this->fail('This should have failed with an invalid from date.');
			} catch (\Throwable $th) {
				$this->assertStringContainsString("The provided from date/time 'Meh' is not a properly formatted date/time.", $th->getMessage());
			}
		}

		public function testconvertToTimeZoneInvalidFromZone() {
			try {
				DateTime::convertToTimeZone('America/Denver', '2021-04-16 15:25:00', '');
				$this->fail('This should have failed with an invalid from time zone.');
			} catch (\Throwable $th) {
				$this->assertStringContainsString("The provided from time zone '' is not a valid time zone.", $th->getMessage());
			}
		}

		public function testconvertToTimeZone() {
			$result = DateTime::convertToTimeZone('America/Denver', '2021-04-16 15:25:00', 'America/Los_Angeles');
			$offset = $result->getTimezone()->getOffset($result) / 3600;
			$calculated_hour = 15 - (((new DateTimeZone('America/Los_Angeles'))->getOffset($result) / 3600) - $offset);
			$this->assertSame("2021-04-16 {$calculated_hour}:25:00", $result->format('Y-m-d G:i:s'));
		}

		public function testconvertToTimeZoneUsingUtcDefault() {
			$result = DateTime::convertToTimeZone('America/Denver', '2021-04-16 15:25:00');
			$offset = $result->getTimezone()->getOffset($result) / 3600;
			$calculated_hour = 15 - (((new DateTimeZone('UTC'))->getOffset($result) / 3600) - $offset);
			$this->assertSame("2021-04-16 {$calculated_hour}:25:00", $result->format('Y-m-d G:i:s'));
		}
	}