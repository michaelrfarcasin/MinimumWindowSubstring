class Solution {

    /**
     * @param String $haystack
     * @param String $needles
     * @return String
     */
    function minWindow($haystack, $needles) {
        $needleCounts = array_count_values(str_split($needles));
        $window = [];
        $have = 0;
        $need = count($needleCounts);
        $resultStart = -1;
        $resultLength = INF;
        $start = 0;
        $haystackSize = strlen($haystack);
        
        for ($end = 0; $end < $haystackSize; $end++) {
            $endLetter = $haystack[$end];
            $window[$endLetter]++;
            
            if (isset($needleCounts[$endLetter]) 
                && $window[$endLetter] == $needleCounts[$endLetter]) {
                $have++;
            }
            
            while ($have == $need) {
                // update our result
                if ($end - $start + 1 < $resultLength) {
                    $resultStart = $start;
                    $resultLength = $end - $start + 1;
                }
                // pop from the left of our window
                $startLetter = $haystack[$start];
                $window[$startLetter]--;
                if (isset($needleCounts[$startLetter]) 
                    && $window[$startLetter] < $needleCounts[$startLetter]) {
                    $have--;
                }
                $start++;
            }
        }
        
        return $resultLength == INF ? '' : substr($haystack, $resultStart, $resultLength);
    }
}
