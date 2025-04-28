<?php

declare(strict_types=1);

namespace Application\Integrations\Telegram;

use Application\Services\LoggerService;

/**
 * Class TelegramWebhookHandler
 *
 * This class handles the interaction with the Telegram API to set a webhook for a Telegram bot.
 * It is responsible for sending the request to set up the webhook URL and logging the result.
 * The class requires the Telegram bot's token, the URL of the webhook, and a logger for logging purposes.
 *
 * @package Application\Integrations\Telegram
 */
class TelegramWebhookHandler
{
    /**
     * @var string $webhookUrl The URL that the Telegram bot will send updates to.
     */
    private string $webhookUrl;

    /**
     * @var string $token The Telegram bot token used for authentication.
     */
    private string $token;

    /**
     * @var LoggerService $logger Logger instance to log events and errors.
     */
    private LoggerService $logger;

    /**
     * TelegramWebhookHandler constructor.
     *
     * Initializes the TelegramWebhookHandler with the required parameters:
     * 
     * @param string $webhookUrl The URL where Telegram will send updates.
     * @param string $token The bot's token for authentication with the Telegram API.
     * @param LoggerService $logger Logger service for logging events.
     */
    public function __construct(string $webhookUrl, string $token, LoggerService $logger)
    {
        $this->webhookUrl = $webhookUrl;
        $this->token = $token;
        $this->logger = $logger;
    }

    /**
     * Set the webhook for the Telegram bot.
     *
     * This method sends a request to the Telegram API to set up the webhook URL for the bot.
     * It performs a cURL request to Telegram's setWebhook endpoint and logs the response.
     * If the webhook is successfully set, it returns true; otherwise, it returns false.
     *
     * @return bool Returns true if the webhook was set successfully, false otherwise.
     */
    public function setWebhook(): bool
    {
        // Build the request URL for setting the webhook
        $setWebhookUrl = "https://api.telegram.org/bot{$this->token}/setWebhook";

        // Request parameters, including the URL of the webhook
        $params = [
            'url' => $this->webhookUrl,
        ];

        // Initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $setWebhookUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For production, enable SSL verification

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check if the cURL request failed
        if ($response === false) {
            // Log the cURL error
            $this->logger->error('cURL error: ' . curl_error($ch));
            curl_close($ch);
            return false;
        }

        // Close cURL session
        curl_close($ch);

        // Decode the JSON response from Telegram
        $result = json_decode($response, true);

        // Log the response from the Telegram API
        $this->logger->info('Telegram API response', ['response' => $result]);

        // Check if the response indicates success
        if (!empty($result['ok']) && $result['ok'] === true) {
            // Log successful webhook setup
            $this->logger->info("✅ Webhook successfully set to: {$this->webhookUrl}");
            return true;
        } else {
            // Log an error if webhook setup failed
            $this->logger->error("❗ Error setting up webhook!");
            return false;
        }
    }
}
