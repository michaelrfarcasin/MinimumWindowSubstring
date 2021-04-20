class Solution {

    /**
     * @param String $haystack
     * @param String $needles
     * @return String
     */
    function minWindow($haystack, $needles) {
        $needleCounts = array_count_values(str_split($needles));
        if (!$this->haystackContainsNeedleCounts($haystack, $needleCounts)) {
            return '';
        }
        $haystackSize = strlen($haystack);
        $needlesSize = strlen($needles);
        $minWindow = $haystack;
        $minWindowLength = $haystackSize;
        $start = 0;
        $end = $needlesSize;
        while ($start + $needlesSize <= $haystackSize) {
            $window = substr($haystack, $start, $end - $start);
            $windowLength = strlen($window);
            if ($this->haystackContainsNeedleCounts($window, $needleCounts)) {
                if ($windowLength < $minWindowLength) {
                    $minWindow = $window;
                    $minWindowLength = strlen($minWindow);
                }
                $start++;
            } else {
                $end++;
                if ($end > $haystackSize) {
                    break;
                }
            }
        }
        
        return $minWindow;
    }
    
    private function haystackContainsNeedleCounts($haystack, $needleCounts) {
        $haystackCounts = array_count_values(str_split($haystack));
        foreach ($needleCounts as $letter => $count) {
            $needleCounts[$letter] = max($count - ($haystackCounts[$letter] ?? 0), 0);
        }
        
        return array_sum($needleCounts) == 0;
    }
}
