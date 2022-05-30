<?php

declare(strict_types=1);

namespace Aih\AihBundle\Service;

use Microsoft\Graph\Graph;
use Microsoft\Graph\Model\User;

class MicrosoftGraph extends AbstractHapply implements MicrosoftGraphInterface
{
    public function getUser(string $user): User
    {
        $graph = $this->getGraph();

        return $graph->createRequest('GET', '/users/'.$user.'/?$expand=manager($levels=1)')
                    ->setReturnType(User::class)
                    ->execute()
        ;
    }

    public function getAllUsers(): array
    {
        $groupId = $this->params->get('aih_aih.azure.alluser');

        return $this->getAllUsersByGroupId($groupId);
    }

    public function getAllUsersByGroupId(string $groupId): array
    {
        $graph = $this->getGraph();

        return $graph->createRequest('GET', '/groups/'.$groupId.'/members?$top=999')
                    ->setReturnType(User::class)
                    ->execute()
        ;
    }

    public function getManager(string $user): User
    {
        $graph = $this->getGraph();

        return $graph->createRequest('GET', '/users/'.$user.'/manager')
                    ->setReturnType(User::class)
                    ->execute()
        ;
    }

    public function getUserDepartement(string $user): string
    {
        $graph = $this->getGraph();

        return $graph->createRequest('GET', '/users/'.$user.'?$select=department')
                    ->setReturnType(User::class)
                    ->execute()
                    ->getDepartment()
        ;
    }

    public function getUserMemberOf(string $user): array
    {
        $graph = $this->getGraph();

        return $graph->createRequest('GET', '/users/'.$user.'/memberOf')
                    ->setReturnType(User::class)
                    ->execute()
        ;
    }

    private function getGraph(): Graph
    {
        $tenantId = $this->params->get('aih_aih.azure.tenantid');
        $url = 'https://login.microsoftonline.com/'.$tenantId.'/oauth2/token?api-version=1.0';

        $token = $this->client->request('POST', $url, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept: */*',
                'User-Agent' => 'HapplyBundle login_check',
            ],
            'body' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->params->get('aih_aih.azure.clientid'),
                'client_secret' => $this->params->get('aih_aih.azure.clientsecret'),
                'resource' => 'https://graph.microsoft.com/',
            ],
        ]);

        $accessToken = json_decode($token->getContent())->access_token;

        $graph = new Graph();
        $graph->setAccessToken($accessToken);

        return $graph;
    }
}
