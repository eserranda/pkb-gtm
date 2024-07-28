<?php

namespace App\Imports;

use App\Models\AnggotaJemaat;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AnggotaJemaatImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        $index = 0;
        foreach ($collection as $row) {
            if ($index > 0) { // Skipping the header row
                // Check if the row is empty
                if ($this->isRowEmpty($row)) {
                    break; // Exit the loop if the row is empty
                }

                $data = [
                    'id_jemaat' => !empty($row[0]) ? $row[0] : null,
                    'nama_anggota' => !empty($row[1]) ? $row[1] : '',
                    'gender' => !empty($row[2]) ? $row[2] : '',
                    'alamat' => !empty($row[3]) ? $row[3] : '',
                    'status_tempat_tinggal' => !empty($row[4]) ? $row[4] : '',
                    'no_telp' => !empty($row[5]) ? $row[5] : '',
                    'mulai_berjemaat' => !empty($row[6]) ?  Date::excelToDateTimeObject($row[6])->format('Y-m-d') : null,
                    'status_pernikahan' => !empty($row[7]) ? $row[7] : '',
                    'tempat_lahir' => !empty($row[8]) ? $row[8] : '',
                    'tgl_lahir' => !empty($row[9]) ? Date::excelToDateTimeObject($row[9])->format('Y-m-d') : null,
                    'pendidikan' => !empty($row[10]) ? $row[10] : '',
                    'pekerjaan' => !empty($row[11]) ? $row[11] : '',
                    'baptis' => !empty($row[12]) ? $row[12] : false,
                    'sidi' => !empty($row[13]) ? $row[13] : false,
                    'nama_ayah' => !empty($row[14]) ? $row[14] : null,
                    'nama_ibu' => !empty($row[15]) ? $row[15] : null,
                    'tgl_pernikahan' => !empty($row[16]) ? Date::excelToDateTimeObject($row[16])->format('Y-m-d') : null,
                    'keterangan' => !empty($row[17]) ? $row[17] : ''
                ];

                AnggotaJemaat::create($data);
            }
            $index++;
        }
    }

    private function isRowEmpty($row)
    {
        foreach ($row as $cell) {
            if (!empty($cell)) {
                return false; // Row is not empty
            }
        }
        return true; // Row is empty
    }
}
