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
        for ($start = 0; $start + $needlesSize <= $haystackSize; $start++) {
            $windowLength = strlen($minWindow);
            for ($length = $needlesSize; ($start + $length <= $haystackSize) && ($length < $windowLength); $length++) {
                $tempWindow = substr($haystack, $start, $length);
                if ($this->haystackContainsNeedleCounts($tempWindow, $needleCounts)) {
                    $minWindow = $tempWindow;
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
