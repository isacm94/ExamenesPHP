<?php

if (!defined('BASEPATH'))
    exit('No se permite el acceso directo al script');

class PDF extends FPDF {

    protected $col = 0; // Columna actual
    protected $y0;      // Ordenada de comienzo de la columna

    // Cabecera de página

    function Header() {

        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);
        // Título
        $this->SetY(18);
        $this->SetX(35);
        $this->Cell(100, 0, utf8_decode('Lista de países'), 0, 2);
        // Logo
        $this->Image('bola_tierra.jpg', 10, 8, 20, 20);
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }

    // Una tabla más completa
    function ImprovedTable($header, $data) {
        // Anchuras de las columnas
        $w = array(10, 90, 90);//tiene que sumar 190
        // Cabeceras
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode ($header[$i]), 1, 0, 'C');
        $this->Ln();
        
        $i = 1;
        // Datos
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $i, 'LR');
            $this->Cell($w[1], 6, utf8_decode($row['nombre']), 'LR');
            $this->Cell($w[2], 6, utf8_decode($row['continente']), 'LR');
            $this->Ln();
            $i++;
            if ($this->GetY() > 264) {
            $this->AddPage();
        }
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Cargar los datos
    function LoadData($file) {
        // Leer las líneas del fichero
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }

    function CreaTablaLineaPedidos($data) {
        $this->Ln(10);
        //CABECERA tabla
        // Colores, ancho de línea y fuente en negrita        
        $this->SetFillColor(26, 188, 156); //Verde agua
        $this->SetTextColor(255);
        $this->SetDrawColor(255, 255, 255);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        //Datos
        $header = array('CAMISETA', 'PRECIO', 'IVA', 'CANTIDAD', 'TOTAL');
        $w = array(83, 25, 22, 35, 25);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();

        //CUERPO
        // Restauración de colores y fuentes
        $this->SetFillColor(223, 223, 223); //gris
        $this->SetTextColor(0);
        $this->SetFont('', '', 10);

        // Datos
        $fill = true; //Para que empiece en gris la fila
        foreach ($data as $row) {
            $this->Cell($w[0], 6, utf8_decode($row['nombre_cam']), 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, utf8_decode($row['precio']) . " " . iconv('UTF-8', 'windows-1252', '€'), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, utf8_decode($row['iva']) . "%", 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, utf8_decode($row['cantidad']), 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, utf8_decode($row['importe']) . " " . iconv('UTF-8', 'windows-1252', '€'), 'LR', 0, 'L', $fill);
            $this->Ln();
            if ($this->GetY() > 264) {
                $this->AddPage();
            }
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');

        $this->Ln(10); //Salto de linea

        if ($this->GetY() > 264) {
            $this->AddPage();
        }
    }

    function CreaTablaPedido($data) {
        //CABECERA tabla
        // Colores, ancho de línea y fuente en negrita        
        $this->SetFillColor(26, 188, 156); //Verde agua
        $this->SetTextColor(255);
        $this->SetDrawColor(255, 255, 255);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        //Datos
        $header = array('IMPORTE TOTAL', 'CANTIDAD TOTAL', 'ESTADO', 'FECHA PEDIDO');
        $w = array(50, 50, 40, 50);

        $this->Cell($w[0], 7, utf8_decode($header[0]), 1, 0, 'C', true);
        $this->Cell($w[1], 7, utf8_decode($header[1]), 1, 0, 'C', true);
        $this->Cell($w[2], 7, utf8_decode($header[2]), 1, 0, 'C', true);
        $this->Cell($w[3], 7, utf8_decode($header[3]), 1, 0, 'C', true);
        $this->Ln();

        //CUERPO
        // Restauración de colores y fuentes
        $this->SetFillColor(223, 223, 223); //gris
        $this->SetTextColor(0);
        $this->SetFont('', '', 10);

        // Datos
        $CI = & get_instance();
        $CI->load->helper('Fechas');

        $fill = true; //Para que salga en gris la fila              

        $this->Cell($w[0], 6, utf8_decode($data['importe']) . " " . iconv('UTF-8', 'windows-1252', '€'), 'LR', 0, 'L', $fill);
        $this->Cell($w[1], 6, utf8_decode($data['cantidad_total'] . " camisetas"), 'LR', 0, 'L', $fill);
        $this->Cell($w[2], 6, utf8_decode($data['estado']), 'LR', 0, 'L', $fill);
        $this->Cell($w[3], 6, utf8_decode(cambiaFormatoFecha($data['fecha_pedido'])), 'LR', 0, 'L', $fill);

        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
        $this->Ln(10); //Salto de linea   
    }

    function SetCol($col) {
        // Establecer la posición de una columna dada
        $this->col = $col;
        $x = 10 + $col * 65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

    function AcceptPageBreak() {
        // Método que acepta o no el salto automático de página
        if ($this->col < 2) {
            // Ir a la siguiente columna
            $this->SetCol($this->col + 1);
            // Establecer la ordenada al principio
            $this->SetY($this->y0);
            // Seguir en esta página
            return false;
        } else {
            // Volver a la primera columna
            $this->SetCol(0);
            // Salto de página
            return true;
        }
    }

    function ChapterTitle($num, $label) {
        // Título
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200, 220, 255);
        $this->Cell(0, 6, "Capítulo $num : $label", 0, 1, 'L', true);
        $this->Ln(4);
        // Guardar ordenada
        $this->y0 = $this->GetY();
    }

    function ChapterBody($file) {
        // Abrir fichero de texto
        $txt = file_get_contents($file);
        // Fuente
        $this->SetFont('Times', '', 12);
        // Imprimir texto en una columna de 6 cm de ancho
        $this->MultiCell(60, 5, $txt);
        $this->Ln();
        // Cita en itálica
        $this->SetFont('', 'I');
        $this->Cell(0, 5, '(fin del extracto)');
        // Volver a la primera columna
        $this->SetCol(0);
    }

    function PrintChapter($num, $title, $file) {
        // Añadir capítulo
        $this->AddPage();
        $this->ChapterTitle($num, $title);
        $this->ChapterBody($file);
    }

}
