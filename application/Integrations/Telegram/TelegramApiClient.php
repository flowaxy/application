<?php

declare(strict_types=1);

namespace Application\Integrations\Telegram;

use Application\Services\LoggerService;
use RuntimeException;

/**
 * Class TelegramApiClient
 *
 * This class is responsible for making requests to the Telegram API.
 * It uses cURL to send data to the Telegram API and handles the response.
 * The client is initialized with a Telegram bot token and constructs the appropriate API URL.
 *
 * @package Application\Integrations\Telegram
 */
class TelegramApiClient
{
    /**
     * @var string $apiUrl The base URL for the Telegram API, constructed using the bot token.
     */
    private string $apiUrl;

    /**
     * @var LoggerService $logger Logger instance for logging operations and errors.
     */
    private LoggerService $logger;

    /**
     * TelegramApiClient constructor.
     *
     * Initializes the TelegramApiClient with a bot token and sets the API URL.
     *
     * @param string $token The bot token used to authenticate API requests.
     */
    public function __construct(private readonly string $token)
    {
        $this->apiUrl = "https://api.telegram.org/bot{$this->token}/";
        $this->logger = new LoggerService('integrations/telegram/api_client');
    }

    /**
     * Send a message to a Telegram chat using the sendMessage method of the Telegram API.
     *
     * @param array $data The data to send with the message (e.g., 'chat_id', 'text', etc.).
     * @return array The response from the Telegram API.
     */
    public function sendMessage(array $data): array
    {
        return $this->request('sendMessage', $data);
    }

    /**
     * Make a request to the Telegram API using the specified method and data.
     *
     * This method sends a cURL request to the Telegram API and handles the response, including error handling.
     * It also logs relevant information about the request and response.
     *
     * @param string $method The Telegram API method to call (e.g., 'sendMessage').
     * @param array $data The data to send with the request.
     * @return array The decoded response from the Telegram API.
     * @throws RuntimeException If there is an error during the request or response decoding.
     */
    private function request(string $method, array $data): array
    {
        $url = "{$this->apiUrl}{$method}";

        // Log the request details
        $this->logger->debug('Sending request to Telegram API', [
            'url'  => $url,
            'data' => $data
        ]);

        // Initialize cURL session
        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_POST           => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_HTTPHEADER     => ['Content-Type: application/x-www-form-urlencoded'],
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Error handling for cURL execution
        if ($response === false) {
            $error = curl_error($ch);
            $this->logger->error('Error making request to Telegram API', ['curl_error' => $error]);
            curl_close($ch);
            throw new RuntimeException('Telegram API Request Error: ' . $error);
        }

        // Close the cURL session
        curl_close($ch);

        // Decode the response from JSON
        $decoded = json_decode($response, true);

        // Error handling for JSON decoding
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->logger->error('Error decoding Telegram API response', ['json_error' => json_last_error_msg()]);
            throw new RuntimeException('Failed to decode Telegram API response: ' . json_last_error_msg());
        }

        // Check if the response indicates an error from the Telegram API
        if (($decoded['ok'] ?? false) !== true) {
            $description = $decoded['description'] ?? 'Unknown error';
            $this->logger->warning('Telegram API returned an error', [
                'http_status' => $httpStatus,
                'description' => $description,
                'response'    => $decoded,
            ]);
            throw new RuntimeException("Telegram API error ({$httpStatus}): {$description}");
        }

        // Log the successful response
        $this->logger->info('Successful response from Telegram API', ['response' => $decoded]);

        // Return the decoded response
        return $decoded;
    }
}
