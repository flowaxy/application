<?php

declare(strict_types=1);

namespace Application\Integrations\Telegram;

use Application\Services\LoggerService;
use RuntimeException;
use JsonException;

/**
 * Class TelegramBotService
 *
 * This class provides functionality to send messages to a specified Telegram chat.
 * It allows setting a message, adding buttons, and sending the message to the Telegram bot via the Telegram API.
 * The class requires a `TelegramApiClient` for communication with the Telegram API and a `chatId` to specify the target chat.
 *
 * @package Application\Integrations\Telegram
 */
class TelegramBotService
{
    /**
     * @var string $message The message to be sent to the Telegram chat.
     */
    private string $message = '';

    /**
     * @var array $buttons Buttons to be included with the message, if any.
     */
    private array $buttons = [];

    /**
     * @var LoggerService $logger Logger instance for logging operations and errors.
     */
    private LoggerService $logger;

    /**
     * TelegramBotService constructor.
     *
     * Initializes the TelegramBotService with a TelegramApiClient and a chatId.
     *
     * @param TelegramApiClient $client The API client used to interact with Telegram.
     * @param int|string $chatId The ID of the chat to which the message will be sent.
     */
    public function __construct(
        private readonly TelegramApiClient $client,
        private readonly int|string $chatId
    ) {
        $this->logger = new LoggerService('integrations/telegram/bot_service');
    }

    /**
     * Set the message to be sent.
     *
     * @param string $message The message to be sent.
     * @return self The current instance for method chaining.
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        $this->logger->debug('Message set', ['message' => $message]);
        return $this;
    }

    /**
     * Add a button to the message.
     *
     * @param string $text The text to display on the button.
     * @param string $url The URL the button will link to.
     * @return self The current instance for method chaining.
     */
    public function addButton(string $text, string $url): self
    {
        $this->buttons[] = [['text' => $text, 'url' => $url]];
        $this->logger->debug('Button added', ['text' => $text, 'url' => $url]);
        return $this;
    }

    /**
     * Send the message to Telegram.
     *
     * This method builds the payload for the Telegram API and sends it using the `sendMessage` method of the `TelegramApiClient`.
     * It handles potential errors such as empty messages or JSON encoding issues for the buttons.
     *
     * @return array The response from the Telegram API.
     * @throws RuntimeException If there is an error during the sending process, including empty message or button encoding failure.
     */
    public function send(): array
    {
        // Check if the message is empty
        if (trim($this->message) === '') {
            $this->logger->error('Attempt to send an empty message');
            throw new RuntimeException('Cannot send an empty message.');
        }

        // Prepare the payload for the API request
        $payload = [
            'chat_id'    => $this->chatId,
            'text'       => $this->message,
            'parse_mode' => 'HTML',
        ];

        // Add buttons to the payload if any are set
        if (!empty($this->buttons)) {
            try {
                $payload['reply_markup'] = json_encode(
                    ['inline_keyboard' => $this->buttons],
                    JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE
                );
            } catch (JsonException $e) {
                $this->logger->error('Button encoding error', ['exception' => $e->getMessage()]);
                throw new RuntimeException('Button encoding error: ' . $e->getMessage());
            }
        }

        // Log the message sending attempt
        $this->logger->info('Sending message via Telegram API', ['payload' => $payload]);

        // Send the message using the Telegram API client
        return $this->client->sendMessage($payload);
    }
}
