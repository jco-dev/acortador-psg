<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EstadisticaModel;
use App\Models\LinkModel;

class Home extends BaseController
{
    public function index($url_corto)
    {
        $linkm = new LinkModel();
        $link = $linkm->where('url_corto', $url_corto)->first();
        if ($link == NULL) {
            header("Location: https://cursosposgrado.upea.bo");
            exit();
        } else {
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
        }
    }

    public function getUserAgentInfo(): string
    {
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion() . '/' . $agent->getPlatform();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        return $currentAgent;
    }
}
