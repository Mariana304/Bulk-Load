<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Csv\Reader;
use App\Models\Carga;

class CargaController extends Controller
{
    public function cargarCSV(Request $request)
{
    if ($request->hasFile('archivo_csv')) {
        $archivo = $request->file('archivo_csv');
        $csv = Reader::createFromPath($archivo->getPathname());

        // Omitir la primera fila si contiene encabezados
        $csv->setHeaderOffset(0);

       //   return $csv;

       

        foreach ($csv as $fila) {
        
                 $ticket_numbers = $fila['ticket_number'];
                 $ticket_number = intval($ticket_numbers);

                 $ticket_ids = $fila['ticket_id'];
                 $ticket_id = intval($ticket_ids);

                 $ratings = $fila['rating'];
                 $rating = intval($ratings);


            // Suponiendo que estás utilizando un modelo llamado "Elemento"
            Carga::create([
                'timestamps_old' => $fila['timestamp'],
                'user_ip' => $fila['user_ip'],
                'ticket_number' => $ticket_number,
                'date' => $fila['ticket_date'],
                'ticket_id' => $ticket_id,
                'status' => $fila['ticket_status'],
                'rating' => $rating,
                'comments' => $fila['comments'],
                // ... continuar con los campos
            ]);
        }

        return redirect()->back()->with('success', 'Archivo CSV cargado exitosamente.');
    }

    return redirect()->back()->with('error', 'No se proporcionó un archivo CSV.');
}
}
