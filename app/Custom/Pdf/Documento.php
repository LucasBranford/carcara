<?php


namespace App\Custom\Pdf;
use Com\Tecnick\Pdf\Tcpdf;
use Com\Tecnick\Pdf\TextHAlign;
use Com\Tecnick\Pdf\TextVAlign;

class Documento extends Tcpdf
{


    // public function Header()
    // {

        
    // }
  public function Rodape(): void
    {
        $total = $this->page->getPageId() + 1; // índice da última página + 1

        // Liberation Serif, se já tiver sido convertida; senão usa Times como reserva
        $chave = is_file(K_PATH_FONTS . '/liberationserif.json') ? 'liberationserif' : 'times';
        $fonte = $this->font->insert($this->pon, $chave, '', 10);

        $linha = [
            'lineWidth' => 0.25,
            'lineCap'   => 'butt',
            'lineJoin'  => 'miter',
            'dashArray' => [],
            'dashPhase' => 0,
            'lineColor' => 'black',
        ];

        for ($pid = 0; $pid < $total; $pid++) {
            $y = $this->page->getPage($pid)['height'] - 20; // 20 mm acima da borda inferior (277 no A4)

            if ($pid === 0) {
                $html = 'Cópia digital gerada em ' . date('d/m/Y à\s H\hi\m\i\ns\s')
                    . '<br>Este documento é apenas produto de teste, portanto, não é legítimo '
                    . 'e seu conteúdo é meramente figurativo';
            } else {
                $html = 'Pág. ' . ($pid + 1) . '/' . $total;
            }

            $this->page->addContent($fonte['out'], $pid);
            $this->page->addContent($this->graph->getLine(24, $y, 190, $y, $linha), $pid);
            $this->page->addContent(
                $this->getHTMLCell(
                    html: '<div style="text-align:center;">' . $html . '</div>',
                    posx: 30,
                    posy: $y,
                    width: 156,
                    height: 15,
                ),
                $pid
            );
        }
    }
}
