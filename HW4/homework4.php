<?php
    /**
     * Homework 4 - PHP Introduction
     *
     * Computing ID: hws7ug
     * Resources used: String functions in php: https://www.php.net/manual/en/ref.strings.php
     */
     
    function calculateGrade($scores, $drop) {
        $lowestPercentage = 100;
        $lowestIndex = -1;
        $totalScore = 0;
        $totalMaxPoints = 0;
        foreach ($scores as $index => $scoreArray) {
            $score = $scoreArray["score"];
            $maxPoints = $scoreArray["max_points"];
            $percentage = ($score / $maxPoints) * 100;
                if ($percentage < $lowestPercentage) {
                $lowestPercentage = $percentage;
                $lowestIndex = $index;
            }
            $totalScore += $score;
            $totalMaxPoints += $maxPoints;
        }
        if ($drop && $lowestIndex != -1) {
            $totalScore -= $scores[$lowestIndex]["score"];
            $totalMaxPoints -= $scores[$lowestIndex]["max_points"];
        }
        if ($totalMaxPoints > 0) {
            return round(($totalScore / $totalMaxPoints) * 100, 3);
        } else {
            return 0;
        }
    }
    function gridCubbies($width, $height) {
        $grid_array = [];
        if ($width < 2 || $height < 2) {
            for ($i = 1; $i <= $width; $i++) {
                $grid_array[] = $i;
                if ($height > 1) {
                    $grid_array[] = ($height - 1) * $width + $i;
                }
            }
            for ($i = 2; $i < $height; $i++) {
                $grid_array[] = ($i - 1) * $width + 1;
                if ($width > 1) {
                    $grid_array[] = $i * $width;
                }
            }
        } else {
            //Bottom-left corner
            $grid_array[] = 1;
            $grid_array[] = 2;
            $grid_array[] = $height + 1;
            $grid_array[] = $height + 2;
     
            //Bottom-right corner
            $grid_array[] = ($height * ($width - 1)) + 1;
            $grid_array[] = ($height * ($width - 1)) + 2;
            $grid_array[] = ($height * ($width - 2)) + 1;
            $grid_array[] = ($height * ($width - 2)) + 2;
    
            //Top-left corner
            $grid_array[] = $height;
            $grid_array[] = $height - 1;
            $grid_array[] = $height * 2;
            $grid_array[] = ($height * 2) - 1;
    
            //Top-right corner
            $grid_array[] = ($height * $width) - 1;
            $grid_array[] = ($height * $width);
            $grid_array[] = ($height * ($width - 1));
            $grid_array[] = ($height * ($width - 1)) - 1;
        }
        $grid_array = array_unique($grid_array); 
        sort($grid_array);
        return implode(', ', $grid_array);
    }
    function combineAddressBooks(...$addressBooks) {
        $consolidatedContacts = [];
        foreach ($addressBooks as $individualBook) {
            foreach ($individualBook as $person => $details) {
                if (!array_key_exists($person, $consolidatedContacts)) {
                    $consolidatedContacts[$person] = (array)$details;
                } else {
                    $existingDetails = is_array($consolidatedContacts[$person]) ? $consolidatedContacts[$person] : [$consolidatedContacts[$person]];
                    $additionalDetails = is_array($details) ? $details : [$details];
                    $consolidatedContacts[$person] = array_unique(array_merge($existingDetails, $additionalDetails));
                }
            }
        }
        return $consolidatedContacts;
    }    
    function acronymSummary($acronyms, $searchString) {
        $foundCounts = [];
        if (!is_string($acronyms) || !is_string($searchString) || empty($acronyms) || empty($searchString)) {
            return []; 
        }
        $abbrList = explode(' ', $acronyms);
        $wordsInText = explode(' ', strtolower($searchString));
        foreach ($abbrList as $abbrOriginal) {
            $matchCount = 0;
            $abbr = strtolower($abbrOriginal);
    
            for ($i = 0; $i <= count($wordsInText) - strlen($abbr); $i++) {
                $matches = true;
                for ($j = 0; $j < strlen($abbr); $j++) {
                    if (!isset($wordsInText[$i + $j]) || $abbr[$j] !== $wordsInText[$i + $j][0]) {
                        $matches = false;
                        break;
                    }
                }
                if ($matches) {
                    $matchCount++;
                    $i += strlen($abbr) - 1; 
                }
            }
            $foundCounts[$abbrOriginal] = $matchCount;
        }
        return $foundCounts;
    }
    
?>

    
    