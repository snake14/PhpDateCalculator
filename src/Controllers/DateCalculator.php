<?php
    namespace Controllers;

    class DateCalculator {
        public function getMainPage($f3, $params) {
			echo \Template::instance()->render('../views/main.htm');
        }

		private function _calculateFromDate() {
			try {
				$date = \Helpers\DateTime::calculateFromDate($_POST['date'], $_POST['operation'], $_POST['amount'], $_POST['unit_type']);
			} catch (\Throwable $th) {
				echo \json_encode([ 'success' => false, 'result' => $th->getMessage() ]);
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
				echo \json_encode([ 'success' => false, 'result' => $th->getMessage() ]);
				exit;
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
				echo \json_encode([ 'success' => false, 'result' => $th->getMessage() ]);
				exit;
			}
			$time_diff_result = $diff->format('%d Days').'<br>';
			$time_diff_result .= $diff->format('%h Hours').'<br>';
			$time_diff_result .= $diff->format('%i Minutes');
			echo \json_encode([ 'success' => true, 'result' => $time_diff_result ]);
		}
	}