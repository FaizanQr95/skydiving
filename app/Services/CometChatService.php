<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class CometChatService
{
    protected $httpClient;
    protected $appId;
    protected $apiKey;
    protected $region;
    protected $baseUrl;

    public function __construct()
    {
        $this->appId = config('services.cometchat.app_id');
        $this->apiKey = config('services.cometchat.api_key');
        $this->region = config('services.cometchat.region');

        if (!$this->appId || !$this->apiKey || !$this->region) {
            throw new \RuntimeException('CometChat credentials are not configured properly.');
        }

        // Construct the base URL based on the region
        // Example: https://<APP_ID>.api-<REGION>.cometchat.io/v3
        // Check CometChat REST API documentation for the exact URL structure
        $this->baseUrl = "https://{$this->appId}.api-{$this->region}.cometchat.io/v3"; // Adjust v3 if API version changes

        $this->httpClient = new Client([
            'base_uri' => $this->baseUrl . '/', // Note the trailing slash
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
                'apiKey'       => $this->apiKey, // Common header for API key
                // 'appId'        => $this->appId, // Some APIs might require appId in header too
            ],
            'timeout'  => 10.0, // Default timeout
        ]);
    }

    /**
     * Make a request to CometChat API.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $endpoint API endpoint path (e.g., 'users')
     * @param array $options Guzzle request options (e.g., json for body)
     * @return array|null Decoded JSON response or null on failure
     */
    protected function makeRequest(string $method, string $endpoint, array $options = []): ?array
    {
        try {
            Log::debug("CometChat API Request: {$method} {$this->baseUrl}/{$endpoint}", $options);

            $response = $this->httpClient->request($method, $endpoint, $options);
            $body = $response->getBody()->getContents();
            $decodedResponse = json_decode($body, true);

            Log::debug("CometChat API Response: {$response->getStatusCode()}", ['body' => $decodedResponse]);

            // CometChat API often wraps successful data in a 'data' key
            // return $decodedResponse['data'] ?? $decodedResponse;
            return $decodedResponse; // Return the whole response to check structure

        } catch (RequestException $e) {
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 500;
            $responseBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : $e->getMessage();
            Log::error("CometChat API Error: {$method} {$endpoint} - Status: {$statusCode}", [
                'message' => $e->getMessage(),
                'response_body' => json_decode($responseBody, true) ?? $responseBody,
                'request_options' => $options
            ]);
            // You might want to throw a custom exception here
            return null;
        } catch (\Exception $e) {
            Log::error("CometChat Service Generic Error: {$method} {$endpoint}", [
                'message' => $e->getMessage(),
                'request_options' => $options
            ]);
            return null;
        }
    }

    /**
     * Create a user in CometChat.
     * Refer to: https://www.cometchat.com/docs/chat-apis-create-user
     *
     * @param string $uid User ID
     * @param string $name User's name
     * @param array $metadata Optional metadata
     * @param string|null $avatarURL Optional avatar URL
     * @param array $tags Optional tags
     * @return array|null User data or null on failure
     */
    public function createUser(string $uid, string $name, array $metadata = [], ?string $avatarURL = null, array $tags = []): ?array
    {
        $payload = [
            'uid' => $uid,
            'name' => $name,
        ];
        if (!empty($metadata)) {
            $payload['metadata'] = $metadata;
        }
        if ($avatarURL) {
            $payload['avatar'] = $avatarURL;
        }
        if (!empty($tags)) {
            $payload['tags'] = $tags;
        }
        // Add other fields like 'role' if needed

        $response = $this->makeRequest('POST', 'users', ['json' => $payload]);
        return $response['data'] ?? $response; // Successful user creation usually returns data in 'data' key
    }

    /**
     * Get user details from CometChat.
     * Refer to: https://www.cometchat.com/docs/chat-apis-get-user
     *
     * @param string $uid User ID
     * @return array|null User data or null on failure
     */
    public function getUser(string $uid): ?array
    {
        $response = $this->makeRequest('GET', "users/{$uid}");
        return $response['data'] ?? $response;
    }

    /**
     * Update a user in CometChat.
     * Refer to: https://www.cometchat.com/docs/chat-apis-update-user
     *
     * @param string $uid User ID
     * @param array $data Data to update (e.g., ['name' => 'New Name', 'avatar' => 'new_url'])
     * @return array|null User data or null on failure
     */
    public function updateUser(string $uid, array $data): ?array
    {
        $response = $this->makeRequest('PUT', "users/{$uid}", ['json' => $data]);
        return $response['data'] ?? $response;
    }

    /**
     * Generate an Auth Token for a user.
     * This uses the separate Auth Tokens API endpoint and the Auth Key.
     * Refer to: https://www.cometchat.com/docs/chat-apis-login-user-with-auth-token (Create Token section)
     *
     * @param string $uid User ID
     * @param bool $forceCreate Force creation of token even if one exists (optional)
     * @return string|null Auth token or null on failure
     */
    public function createAuthToken(string $uid, bool $forceCreate = false): ?string
    {
        $authKey = config('services.cometchat.auth_key');
        if (!$authKey) {
            Log::error('CometChat Auth Key is not configured.');
            return null;
        }

        $endpoint = "users/{$uid}/auth_tokens";
        $payload = $forceCreate ? ['force' => true] : []; // Optional: force creation

        // For this specific endpoint, the API key used is the Auth Key
        // So we create a temporary client or override headers
        $authTokenClient = new Client([
            'base_uri' => $this->baseUrl . '/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
                'apiKey'       => $authKey, // Use Auth Key here
            ],
            'timeout'  => 10.0,
        ]);

        try {
            Log::debug("CometChat Auth Token Request: POST {$this->baseUrl}/{$endpoint}", ['uid' => $uid, 'force' => $forceCreate]);
            $response = $authTokenClient->request('POST', $endpoint, ['json' => $payload]);
            $body = $response->getBody()->getContents();
            $decodedResponse = json_decode($body, true);
            Log::debug("CometChat Auth Token Response: {$response->getStatusCode()}", ['body' => $decodedResponse]);

            return $decodedResponse['data']['authToken'] ?? null;

        } catch (RequestException $e) {
            $statusCode = $e->hasResponse() ? $e->getResponse()->getStatusCode() : 500;
            $responseBody = $e->hasResponse() ? $e->getResponse()->getBody()->getContents() : $e->getMessage();
            Log::error("CometChat Auth Token API Error: POST {$endpoint} - Status: {$statusCode}", [
                'message' => $e->getMessage(),
                'response_body' => json_decode($responseBody, true) ?? $responseBody,
            ]);
            return null;
        } catch (\Exception $e) {
            Log::error("CometChat Service Generic Error creating Auth Token for UID {$uid}", [
                'message' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Send a text message.
     * Can be user-to-user or user-to-group.
     * Refer to: https://www.cometchat.com/docs/chat-apis-send-message
     *
     * @param string $senderUid UID of the message sender
     * @param string $receiverUid UID of the message receiver (user or group)
     * @param string $receiverType 'user' or 'group'
     * @param string $textMessage The text content of the message
     * @param array $metadata Optional metadata for the message
     * @return array|null Sent message data or null on failure
     */
    public function sendTextMessage(string $senderUid, string $receiverUid, string $receiverType, string $textMessage, array $metadata = []): ?array
    {
        if (!in_array(strtolower($receiverType), ['user', 'group'])) {
            Log::error("Invalid receiverType '{$receiverType}' for sending message.");
            return null;
        }

        $payload = [
            'sender' => $senderUid,
            'receiver' => $receiverUid,
            'receiverType' => strtolower($receiverType),
            'category' => 'message',
            'type' => 'text', // For text messages
            'data' => [
                'text' => $textMessage,
            ],
        ];

        if (!empty($metadata)) {
            $payload['metadata'] = $metadata; // Or $payload['data']['metadata'] = $metadata; check API docs
        }
        // You can add other fields like 'tags' if needed

        $response = $this->makeRequest('POST', 'messages', ['json' => $payload]);
        return $response['data'] ?? $response; // Successful message sending usually returns data in 'data' key
    }

    /**
     * Send a custom message.
     *
     * @param string $senderUid
     * @param string $receiverUid
     * @param string $receiverType 'user' or 'group'
     * @param string $customType A unique identifier for your custom message type
     * @param array $customData The actual custom data payload
     * @return array|null
     */
    public function sendCustomMessage(string $senderUid, string $receiverUid, string $receiverType, string $customType, array $customData): ?array
    {
        if (!in_array(strtolower($receiverType), ['user', 'group'])) {
            Log::error("Invalid receiverType '{$receiverType}' for sending custom message.");
            return null;
        }

        $payload = [
            'sender' => $senderUid,
            'receiver' => $receiverUid,
            'receiverType' => strtolower($receiverType),
            'category' => 'custom',
            'type' => $customType,
            'data' => $customData,
        ];

        $response = $this->makeRequest('POST', 'messages', ['json' => $payload]);
        return $response['data'] ?? $response;
    }


    /**
     * Fetch message history for a one-on-one conversation.
     * Refer to: https://www.cometchat.com/docs/chat-apis-retrieve-messages
     *
     * @param string $userId1 UID of the first user in the conversation
     * @param string $userId2 UID of the second user in the conversation
     * @param int $limit Number of messages to fetch (default 50)
     * @param int|null $beforeMessageId Fetch messages before this message ID (for pagination)
     * @param int|null $afterMessageId Fetch messages after this message ID (for pagination)
     * @return array|null List of messages or null on failure
     */
    public function getConversationMessages(string $userId1, string $userId2, int $limit = 50, ?int $beforeMessageId = null, ?int $afterMessageId = null): ?array
    {
        // CometChat's API for fetching messages between two users usually involves specifying one as the primary
        // and the other as the 'with' user. For simplicity, let's assume the endpoint takes the other user's UID.
        // The actual endpoint might be /users/{UID}/messages or similar, with query params for the other party.

        // Check CometChat API docs: It's usually GET /users/{UID}/messages
        // and you'd need to know which user to consider the 'base' for the query.
        // For support, it's often from the perspective of the logged-in user fetching messages with the other.
        // Let's assume we are fetching messages for $userId1 with $userId2.

        $endpoint = "users/{$userId1}/messages"; // This is a common pattern
        $queryParams = [
            'withUser' => $userId2, // This tells CometChat the other party
            'limit' => $limit,
            'hideDeleted' => true, // Or false, depending on your needs
        ];

        if ($beforeMessageId) {
            $queryParams['before'] = $beforeMessageId; // Parameter name might be 'beforeMessageId', 'before', etc.
        }
        if ($afterMessageId) {
            $queryParams['after'] = $afterMessageId;
        }

        $response = $this->makeRequest('GET', $endpoint, ['query' => $queryParams]);
        return $response['data'] ?? $response; // Messages are usually in the 'data' key
    }

    // Add more methods for other CometChat API endpoints as needed:
    // - createGroup, getGroup, updateGroup, deleteGroup
    // - sendMessage, getMessages
    // - etc.


}
