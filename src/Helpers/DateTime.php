<?php
	namespace Helpers;

	class DateTime {

		const OPERATION_ADD = '+';
		const OPERATION_SUBTRACT = '-';
		const VALID_OPERATIONS = [
			self::OPERATION_ADD,
			self::OPERATION_SUBTRACT
		];

		const UNIT_TYPE_YEAR = 'year';
		const UNIT_TYPE_MONTH = 'month';
		const UNIT_TYPE_DAY = 'day';
		const UNIT_TYPE_HOUR = 'hour';
		const UNIT_TYPE_MINUTE = 'minute';
		const VALID_UNIT_TYPES = [
			self::UNIT_TYPE_YEAR,
			self::UNIT_TYPE_MONTH,
			self::UNIT_TYPE_DAY,
			self::UNIT_TYPE_HOUR,
			self::UNIT_TYPE_MINUTE,
		];

		/**
		 * This takes two dates and returns a DateInterval containing the difference between the two dates.
		 * 
		 * @param string $startDate
		 * @param string $endDate
		 * @return DateInterval
		 * @throws Exception
		 */
		public static function calcDiffBetweenDates(string $startDate, string $endDate): \DateInterval {
			try {
				$date1 = new \DateTime($startDate);
			} catch (\Throwable $th) {
				//TODO: Log the error somewhere.
				throw new Exception("The provided start date '{$startDate}' is not a properly formatted date.");
			}
			
			try {
				$date2 = new \DateTime($endDate);
			} catch (\Throwable $th) {
				//TODO: Log the error somewhere.
				throw new Exception("The provided end date '{$endDate}' is not a properly formatted date.");
			}

			return $date1->diff($date2);
		}

		/**
		 * This takes a date/time and adds/subtracts a certain amount from it.
		 * 
		 * @param string $startDate
		 * @param string $operation
		 * @param int $amount
		 * @param string $unitType
		 * @return DateTime
		 * @throws Exception
		 */
		public static function calculateFromDate(string $startDate, string $operation, int $amount, string $unitType): \DateTime {
			try {
				$date = new \DateTime($startDate);
			} catch (\Throwable $th) {
				//TODO: Log the error somewhere.
				throw new Exception("The provided start date '{$startDate}' is not a properly formatted date.");
			}

			if (!\in_array($operation, self::VALID_OPERATIONS)) {
				//TODO: Log the error somewhere.
				throw new Exception("The provided operation '{$operation}' is not supported.");
			}

			if (!\in_array($unitType, self::VALID_UNIT_TYPES)) {
				//TODO: Log the error somewhere.
				throw new Exception("The provided unit type '{$unitType}' is not supported.");
			}

			return $date->modify("{$operation}{$amount} {$unitType}");
		}
	}
?>