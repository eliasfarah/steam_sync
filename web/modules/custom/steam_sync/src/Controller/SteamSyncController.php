<?php

namespace Drupal\steam_sync\Controller;

use Drupal\user\Entity\User;
use Drupal\Core\Controller\ControllerBase;

class SteamSyncController extends ControllerBase
{

  public function content()
  {

    // Carrega todos os usuários cadastrados.
    $user = User::load(\Drupal::currentUser()->id());

    $apiKey = $user->get('field_steam_api')->value;
    $steamID = $user->get('field_steam_id')->value;

    // Verifica se a chave da API da Steam foi configurada.
    if (empty($apiKey) || empty($steamID)) {
        die('Configure sua chave e ID');
    }

    // // Faça uma solicitação à API da Steam aqui usando a chave da API.
    $url = 'https://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/';
    $params = [
        'key' => $apiKey,
        'steamid' => $steamID, // Substitua pelo seu Steam ID.
        'format' => 'json',
    ];

    // // // Faça a solicitação HTTP aqui usando a biblioteca http_client do Drupal.
    $response = \Drupal::httpClient()->get($url, ['query' => $params]);
    $data = json_decode($response->getBody());

    // Processar os dados da resposta da API da Steam aqui.
    // Você pode percorrer $data->response->games para obter informações sobre os jogos.

    // Exemplo de processamento de dados:
    foreach ($data->response->games as $game) {
        // Faça algo com as informações do jogo, como armazená-las no banco de dados do Drupal.
        // https://cdn.akamai.steamstatic.com/steam/apps/10/header.jpg
        // var_dump($game->);
    }

    die;
    return [
      '#markup' => $this->t('Olá, mundo! Este é um exemplo de página personalizada.'),
    ];
  }
}
