<?php
    namespace Controllers;

	use \Classes\DisplayableError;

    class DateCalculator {
        public function getMainPage($f3, $params) {
			echo \Template::instance()->render('main.htm');
        }

		private function _calculateFromDate() {
			try {
				$date = \Helpers\DateTime::calculateFromDate($_POST['date'], $_POST['operation'], $_POST['amount'], $_POST['unit_type']);
			} catch (\Throwable $th) {
				// Only display the error message directly to the user if it's a specific subclass of Exception that we use.
				$result = $th instanceof DisplayableError ? $th->getMessage() : "There was an issue calculating the answer.";
				echo \json_encode([ 'success' => false, 'result' => $result ]);
				exit;
			}

			return $date;
		}

		public function calculateFromDate($f3, $params) {
			echo \json_encode([ 'success' => true, 'result' => $this->_calculateFromDate()->format('Y-m-d') ]);
		}
		
		public function calculateFromTime($f3, $params) {
			echo \json_encode([ 'success' => true, 'result' => $this->_calculateFromDate()->format('Y-m-d g:i a') ]);
		}

		public function calculateDiffDate($f3, $params) {
			try {
				$diff = \Helpers\DateTime::calcDiffBetweenDates($_POST['date1'], $_POST['date2']);
			} catch (\Throwable $th) {
				// Only display the error message directly to the user if it's a specific subclass of Exception that we use.
				$result = $th instanceof DisplayableError ? $th->getMessage() : "There was an issue calculating the answer.";
				echo \json_encode([ 'success' => false, 'result' => $result ]);
				return;
			}
			$diff_result = $diff->format('%y Years').'<br>';
			$diff_result .= $diff->format('%m Months').'<br>';
			$diff_result .= $diff->format('%d Days');
			echo \json_encode([ 'success' => true, 'result' => $diff_result ]);
		}

		public function calculateDiffTime($f3, $params) {
			try {
				$diff = \Helpers\DateTime::calcDiffBetweenDates($_POST['time1'], $_POST['time2']);
			} catch (\Throwable $th) {
				// Only display the error message directly to the user if it's a specific subclass of Exception that we use.
				$result = $th instanceof DisplayableError ? $th->getMessage() : "There was an issue calculating the answer.";
				echo \json_encode([ 'success' => false, 'result' => $result ]);
				return;
			}
			$time_diff_result = $diff->format('%d Days').'<br>';
			$time_diff_result .= $diff->format('%h Hours').'<br>';
			$time_diff_result .= $diff->format('%i Minutes');
			echo \json_encode([ 'success' => true, 'result' => $time_diff_result ]);
		}
	}