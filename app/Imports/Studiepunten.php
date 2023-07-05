<?php

namespace App\Imports;

use App\Models\StudiepuntenExcel;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class Studiepunten implements ToCollection, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $row)
    {
        $done = false;
        $currentUser = 0;
        while (!$done) {
            $row1 = $currentUser * 2 + 5;
            $row2 = $currentUser * 2 + 6;

            if (!isset($row[$row1][2])) {
                return response()->json(['no_data_found'], 400);
            }
            $counter = 0;
            $lastSubject = null;
            $subjects = [];
            $c_punten = null;
            foreach ($row[0] as $subject) {
                if ($subject != null) {
                    if ($subject == "C-punten") {
                        $c_punten = $row[$row1][$counter];
                        break;
                    }
                    $lastSubject = $subject;
                    $subjects[$subject] = [
                        "fb" => [],
                        "totaal_b_punten" => 2,
                        "behaalde_b_punten" => $row[$row2][$counter]
                    ];
                }
                if ($lastSubject != null) {
                    $subjects[$lastSubject]["fb"][] = [
                        "f_code" => $row[1][$counter],
                        "week" => $row[3][$counter],
                        "totaal_a_punten" => $row[4][$counter],
                        "behaalde_a_punten" => $row[$row1][$counter],
                    ];
                }
                $counter++;
            }
            $data = [
                "vakken" => $subjects,
                "totaal_a_punten" => explode(" / ", $row[$row1][6])[1],
                "behaalde_a_punten" => $row[$row1][5],
                "totaal_b_punten" => explode(" / ", $row[$row2][6])[1],
                "behaalde_b_punten" => $row[$row2][5],
                "behaalde_c_punten" => $c_punten
            ];
            if (StudiepuntenExcel::where('studentennummer', $row[$row1][2])->first() == null) {
                $user = new StudiepuntenExcel([
                    'studentennummer'    => $row[$row1][2],
                    'klascode'    => $row[$row1][1],
                    'studiepunten' => json_encode($data)
                ]);
                $user->save();
            } else {
                $user = StudiepuntenExcel::where('studentennummer', $row[$row1][2])->first();
                $user->studiepunten = json_encode($data);
                $user->save();
            }
            $currentUser++;
        }
    }
}
