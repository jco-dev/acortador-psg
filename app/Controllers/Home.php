<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstadisticaModel;
use App\Models\LinkModel;
use App\Models\PersonaExternaModel;
use App\Models\SugerenciaReclamoModel;

class Home extends BaseController
{
    public $alphabet;
    public $alphabetsForNumbers;
    public function __construct()
    {
        $this->alphabet = array('K', 'g', 'A', 'D', 'R', 'V', 's', 'L', 'Q', 'w');
        $this->alphabetsForNumbers = array(
            array('K', 'g', 'A', 'D', 'R', 'V', 's', 'L', 'Q', 'w'),
            array('M', 'R', 'o', 'F', 'd', 'X', 'z', 'a', 'K', 'L'),
            array('H', 'Q', 'O', 'T', 'A', 'B', 'C', 'D', 'e', 'F'),
            array('T', 'A', 'p', 'H', 'j', 'k', 'l', 'z', 'x', 'v'),
            array('f', 'b', 'P', 'q', 'w', 'e', 'K', 'N', 'M', 'V'),
            array('i', 'c', 'Z', 'x', 'W', 'E', 'g', 'h', 'n', 'm'),
            array('O', 'd', 'q', 'a', 'Z', 'X', 'C', 'b', 't', 'g'),
            array('p', 'E', 'J', 'k', 'L', 'A', 'S', 'Q', 'W', 'T'),
            array('f', 'W', 'C', 'G', 'j', 'I', 'O', 'P', 'Q', 'D'),
            array('A', 'g', 'n', 'm', 'd', 'w', 'u', 'y', 'x', 'r')
        );
    }

    public function index($url_corto)
    {
        $linkm = new LinkModel();
        $link = $linkm->where('url_corto', $url_corto)->first();
        if ($link == NULL) {
            header("Location: https://cursosposgrado.upea.bo");
            exit();
        } else {
            if ($link['redireccion_instantanea'] == 't') {
                $estadistica = new EstadisticaModel();
                if ($estadistica->where('link_id', $link['id'])->where('ip', $this->request->getIPAddress())->first() == NULL) {
                    $estadistica->save([
                        'link_id' => $link['id'],
                        'ip' => $this->request->getIPAddress(),
                        'navegador' => $this->getUserAgentInfo(),
                        'fecha' => date('Y-m-d H:i:s')
                    ]);
                }
                header("Location:" . $link['link']);
                exit();
            } else {
                return view('continuar', ['link_id' => $link['id']]);
            }
        }
    }

    public function getUserAgentInfo(): string
    {
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser())
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion() . '/' . $agent->getPlatform();
        elseif ($agent->isRobot())
            $currentAgent = $agent->getRobot();
        elseif ($agent->isMobile())
            $currentAgent = $agent->getMobile();
        else
            $currentAgent = 'Unidentified User Agent';

        return $currentAgent;
    }

    public function redirect()
    {
        $estadistica = new EstadisticaModel();
        $linkm = new LinkModel();
        $link = $linkm->where('id', $this->request->getPost('id'))->first();
        if ($estadistica->where('link_id', $link['id'])->where('ip', $this->request->getIPAddress())->first() == NULL) {
            $estadistica->save([
                'link_id' => $this->request->getPost('id'),
                'ip' => $this->request->getIPAddress(),
                'navegador' => $this->getUserAgentInfo(),
                'fecha' => date('Y-m-d H:i:s')
            ]);
        }
        header("Location:" . $link['link']);
        exit();
    }

    public function generarCaptcha()
    {
        $expression = (object) array(
            "n1" => rand(0, 5),
            "n2" => rand(0, 4)
        );

        $captchaImage = 'assets/img/captcha/captcha' . time() . '.png';

        $this->generateImage($expression->n1 . ' + ' . $expression->n2 . ' =', $captchaImage);

        $usedAlphabet = rand(0, 9);

        $code = $this->alphabet[$usedAlphabet] .
            $this->alphabetsForNumbers[$usedAlphabet][$expression->n1] .
            $this->alphabetsForNumbers[$usedAlphabet][$expression->n2];

        return $this->response->setJSON([
            'ruta' => $captchaImage,
            'codigo' => $code,
        ]);
    }

    function generateImage($text, $file)
    {
        $im = @imagecreate(135, 37) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($im, 200, 200, 200);
        $text_color = imagecolorallocate($im, 0, 0, 0);
        imagestring($im, 5, 37, 12,  $text, $text_color);
        imagepng($im, $file);
        imagedestroy($im);
    }

    public function getIndex($alphabet, $letter)
    {
        for ($i = 0; $i < count($alphabet); $i++) {
            $l = $alphabet[$i];
            if ($l === $letter) return $i;
        }
    }

    public function getExpressionResult($code)
    {

        $userAlphabetIndex =  $this->getIndex($this->alphabet, substr($code, 0, 1));
        $number1 = (int) $this->getIndex($this->alphabetsForNumbers[$userAlphabetIndex], substr($code, 1, 1));
        $number2 = (int) $this->getIndex($this->alphabetsForNumbers[$userAlphabetIndex], substr($code, 2, 1));
        return $number1 + $number2;
    }

    public function sugerencia()
    {
        $data_persona = [
            'celular' => $this->request->getPost('celular'),
            'nombres' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('nombre'))), MB_CASE_UPPER),
            'apellidos' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('apellidos'))), MB_CASE_UPPER),
        ];

        // validar captcha
        if ($this->getExpressionResult($this->request->getPost('code')) !== (int) $this->request->getPost('result'))
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error en el captcha')
                ->with('sugerencia', true);

        if (!$this->validate('consulta')) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('sugerencia', true);
        }

        /** GUARDAR PERSONA EXTERNA Y VERIFICAR REGISTRO */
        $persona_externa_id = null;
        $persona_externa = new PersonaExternaModel();
        if ($persona_externa->where('celular', $data_persona['celular'])->first() == NULL) {
            $persona_externa->save($data_persona);
            $persona_externa_id = $persona_externa->insertID;
        } else {
            $persona_externa_id = $persona_externa->where('celular', $data_persona['celular'])->first()['id'];
        }

        $data_sugerencia = [
            'persona_externa_id' => $persona_externa_id,
            'link_id' => $this->request->getPost('link_id'),
            'tipo' => $this->request->getPost('tipo'),
            'descripcion' => mb_convert_case(preg_replace('/\s+/', ' ', trim($this->request->getPost('sugerencia'))), MB_CASE_UPPER)
        ];

        /** GUARDAR SUGERENCIA */
        $sugerencia = new SugerenciaReclamoModel();
        if ($sugerencia->save($data_sugerencia))
            return redirect()
                ->back()
                ->with('success', 'Sugerencia enviada con éxito');
        else
            return redirect()
                ->back()
                ->with('errorr', 'Error al enviar sugerencia');
    }
}
